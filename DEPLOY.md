# Déploiement sur AlwaysData

Ce fichier centralise uniquement les étapes de mise en ligne sur AlwaysData.
Pour la doc générale du projet (stack, installation locale, structure), voir
[README.md](README.md).

À suivre case par case le jour du déploiement.

## 0. Avant le tout premier déploiement (une seule fois)

- [ ] Créer le "Site" AlwaysData : document root pointé sur `.../portfolio/public` (jamais la racine du projet).
- [ ] Choisir PHP **8.3 ou supérieur** dans la configuration du site (`composer.json` exige `^8.3`).
- [ ] Décider de la base de données :
  - [ ] **SQLite** (le plus simple) — le stockage AlwaysData est persistant (pas de système de fichiers éphémère comme sur certains PaaS), donc `database/database.sqlite` survit aux déploiements sans précaution particulière ; s'assurer juste qu'il est bien exclu du dépôt Git (déjà le cas via `database/.gitignore`) et créé/migré directement sur le serveur.
  - [ ] Ou **MySQL/PostgreSQL** managé si tu préfères — créer la base dans l'onglet "Databases" d'AlwaysData et noter host/nom/utilisateur/mot de passe.
- [ ] Mettre en place l'accès au code sur le serveur (clone SSH du dépôt, ou déploiement git configuré côté AlwaysData).
- [ ] Générer un **mot de passe admin réel**, différent de celui de dev, et le garder dans un gestionnaire de mots de passe (jamais dans un fichier versionné).
- [ ] Générer une clé API Resend (dev ou dédiée prod) sur [resend.com](https://resend.com) → API Keys.

## 1. Variables d'environnement sur le serveur

Le `.env` de production se crée **directement sur le serveur** (copie de
`.env.example`, jamais le `.env` de dev copié tel quel — notamment pour
`APP_KEY`, générée à part). Valeurs attendues :

| Variable | Valeur attendue en production |
|---|---|
| `APP_NAME` | `Portfolio` (ou le nom choisi) |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://ton-domaine.tld` (URL réelle, en HTTPS) |
| `APP_KEY` | générée **sur le serveur** via `php artisan key:generate --force`, ne jamais réutiliser celle de dev |
| `DB_CONNECTION` | `sqlite` (ou `mysql`/`pgsql` selon le choix fait à l'étape 0) |
| `DB_DATABASE` | chemin absolu du fichier `.sqlite`, ou nom de la base si MySQL/PostgreSQL |
| `SESSION_DRIVER` | `database` |
| `SESSION_SECURE_COOKIE` | `true` (cookie de session envoyé uniquement en HTTPS) |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `database` |
| `MAIL_MAILER` | `resend` |
| `RESEND_API_KEY` | clé Resend réelle (secret — jamais commitée) |
| `MAIL_FROM_ADDRESS` | `onboarding@resend.dev` (fonctionne sans domaine vérifié) ou une adresse sur un domaine vérifié Resend |
| `CONTACT_NOTIFICATION_EMAIL` | ton adresse email réelle, qui recevra les notifications du formulaire de contact |

## 2. Premier déploiement — étapes

- [ ] Récupérer le code sur le serveur (`git clone`/`git pull`).
- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] Assets front — **stratégie retenue par défaut : pas d'installation de Node côté serveur.** On build en local et on transfère le résultat :
  - [ ] `npm run build` **en local**
  - [ ] Transférer le dossier `public/build/` généré vers le serveur par SSH/SFTP/rsync — ce dossier est volontairement exclu du dépôt Git (`.gitignore`), il n'arrive donc jamais tout seul via `git pull`.
  - (Si un jour Node devient disponible/souhaité côté AlwaysData, l'alternative est `npm ci && npm run build` directement sur le serveur — non retenue pour l'instant.)
- [ ] Créer le `.env` sur le serveur à partir de `.env.example` et renseigner le tableau de la section 1.
- [ ] `php artisan key:generate --force`
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --class=AdminUserSeeder`
- [ ] `php artisan storage:link`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] Vérifier que `/`, `/parcours-projets`, `/articles-contact` et `/login` répondent bien (pas d'erreur 500).
- [ ] Se connecter sur `/admin` avec le compte admin et vérifier que le dashboard s'affiche.
- [ ] Tester le formulaire de contact et confirmer la réception de l'email de notification.

## 3. ⚠️ Juste après le premier déploiement

- [ ] **Changer immédiatement le mot de passe admin** depuis `/profile` si le seeder a été lancé avec le placeholder `change-me-now` de `database/seeders/AdminUserSeeder.php` — ne jamais laisser ce mot de passe placeholder actif sur un site public.
- [ ] Visiter une URL invalide (ex. `/xyz-inexistant`) et confirmer que la page 404 personnalisée s'affiche **sans** trace technique (stacktrace, chemin de fichier, nom de package) — signe que `APP_DEBUG=false` est bien pris en compte.

## 4. Reverse proxy / HTTPS (à trancher une fois AlwaysData configuré)

`bootstrap/app.php` contient un `trustProxies` commenté, prêt à l'emploi :

```php
// $middleware->trustProxies(at: '*');
```

- [ ] Si AlwaysData place le site derrière un reverse proxy qui termine le HTTPS (à vérifier une fois le site en ligne : liens générés en `http://` au lieu de `https://`, ou erreurs de redirection en boucle), décommenter cette ligne.
- [ ] Sinon, laisser commenté.

## 5. Après chaque déploiement suivant (mise à jour du code)

- [ ] Récupérer le nouveau code (`git pull` ou équivalent).
- [ ] `composer install --no-dev --optimize-autoloader` (si `composer.json`/`composer.lock` a changé).
- [ ] Si des fichiers de `resources/` ont changé : `npm run build` en local, puis transférer `public/build/` vers le serveur par SSH/SFTP/rsync (voir section 2 — pas de build sur le serveur).
- [ ] `php artisan migrate --force` (si de nouvelles migrations existent).
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`

(`storage:link` n'est à relancer que si `storage/app/public` a été recréé de zéro — pas nécessaire à chaque déploiement.)
