# Portfolio

Site portfolio personnel : un espace public (profil, parcours & projets, articles & contact) et un dashboard d'administration protégé par authentification pour gérer soi-même son contenu (projets, compétences, parcours, articles, candidatures). Le site public propose un thème sombre (par défaut) et un thème clair, avec bascule persistante.

## Stack

- **Laravel 13** (PHP 8.4)
- **Blade** + **Laravel Breeze** pour l'authentification (compte admin unique, pas d'inscription publique)
- **Tailwind CSS** + **Alpine.js**
- **SQLite** en développement
- **Resend** pour l'envoi des e-mails (notifications du formulaire de contact)
- Favicon/branding « Gn » généré par script (police Black Ops One, fond noir) — voir `public/favicon.ico`, `favicon-32x32.png`, `favicon-512x512.png`, `apple-touch-icon.png`

## Installation locale

```bash
git clone <url-du-depot> portfolio
cd portfolio

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan db:seed --class=AdminUserSeeder
php artisan storage:link

npm run build
php artisan serve
```

L'application est alors disponible sur `http://localhost:8000`.

En développement, tu peux remplacer `npm run build` par `npm run dev` (Vite en mode watch) dans un terminal séparé.

### Note Windows : certificats SSL

Si des requêtes HTTPS sortantes (envoi de mail via Resend, appels à une API externe, etc.) échouent avec une erreur du type `cURL error 60: SSL certificate ... unable to get local issuer certificate`, c'est que PHP n'a pas de certificats racine configurés (fréquent sur une install PHP Windows manuelle). Corrige en téléchargeant le pack de certificats de Mozilla et en le référençant dans `php.ini` :

```ini
[curl]
curl.cainfo = "C:\chemin\vers\cacert.pem"

[openssl]
openssl.cafile = "C:\chemin\vers\cacert.pem"
```

(bundle téléchargeable sur https://curl.se/ca/cacert.pem) puis redémarre `php artisan serve`.

## Compte admin par défaut

Le seeder `AdminUserSeeder` crée un unique compte administrateur :

- **Email** : `admin@example.com`
- **Mot de passe** : `change-me-now` (placeholder)

**Change le mot de passe avant toute mise en ligne réelle**, de deux façons possibles :

- éditer `database/seeders/AdminUserSeeder.php` avant de lancer le seeder, ou
- se connecter une première fois puis changer le mot de passe depuis `/profile`.

Le dashboard est accessible sur `/admin` une fois connecté. La page de connexion (`/login`) et les pages d'erreur (404, 403, 419, 429, 500, 503 — voir `resources/views/errors/`) reprennent l'habillage visuel du site (fond sombre, logo « Gn » en Black Ops One, boutons pilule).

## Données de démonstration (optionnel)

Un `DemoSeeder` insère des données réalistes mais fictives (compétences, expériences, projets publiés avec compétences liées, articles, candidatures à statuts variés) — pratique pour visualiser le site rempli ou faire des captures d'écran. Il n'est **jamais** lancé automatiquement (ni par `DatabaseSeeder`, ni en production) :

```bash
php artisan db:seed --class=DemoSeeder
```

Le seeder est idempotent (relancer la commande ne crée pas de doublons).

## Notifications mail (formulaire de contact)

L'envoi passe par **Resend** (`resend/resend-laravel`). Variables `.env` concernées :

- `MAIL_MAILER=resend` et `RESEND_API_KEY` (clé générée sur [resend.com](https://resend.com) → API Keys)
- `MAIL_FROM_ADDRESS` — `onboarding@resend.dev` fonctionne immédiatement sans vérification de domaine (suffisant pour un formulaire qui t'envoie les messages à toi-même)
- `CONTACT_NOTIFICATION_EMAIL` — l'adresse qui reçoit une notification à chaque nouveau message

En développement sans clé Resend, mets `MAIL_MAILER=log` : les mails s'écrivent dans `storage/logs/laravel.log` au lieu d'être envoyés réellement.

Si l'envoi échoue (clé invalide, panne du provider, etc.), l'erreur est loguée (`storage/logs/laravel.log`) mais **n'empêche jamais** l'enregistrement du message en base (table `contact_messages`) ni la confirmation affichée à l'utilisateur.

## Thème clair / sombre (site public)

Le site public propose un bouton de bascule dans la navbar (icône soleil/lune). Fonctionnement :

- Choix initial : dernier choix enregistré (`localStorage`) → sinon préférence système (`prefers-color-scheme`) → sinon sombre par défaut.
- Le thème est appliqué via un attribut `data-theme` sur `<html>`, posé par un script bloquant dans `layouts/app.blade.php` avant le premier rendu (pas de flash visuel).
- Les couleurs (`ink` = surfaces, `paper` = texte/contraste, `accent`) sont des variables CSS définies dans `resources/css/app.css` (`:root` pour le sombre, `[data-theme="light"]` pour l'inversion) et lues par `tailwind.config.js` — donc toute nouvelle vue qui utilise `bg-ink`/`text-paper`/etc. s'adapte automatiquement aux deux thèmes sans code supplémentaire.
- **Portée volontairement limitée au site public** : le dashboard admin (`layouts/admin.blade.php`) ne charge pas ce script et reste toujours en thème sombre.

## Déploiement — état actuel et checklist

**Déjà en place :**

- Suite de tests verte (`php artisan test` → 23/23) couvrant l'authentification, la confirmation de mot de passe et la vérification d'email.
- Compte admin unique, inscription publique désactivée, rate limiting natif sur `/login` (5 tentatives, hérité de Breeze).
- Aucun secret réel dans le dépôt : `.env` est ignoré par Git, `.env.example` ne contient que des placeholders, le mot de passe admin dans `AdminUserSeeder.php` est un placeholder (`change-me-now`).
- Pages d'erreur personnalisées (404, 403, 419, 429, 500, 503) qui s'affichent automatiquement dès que `APP_DEBUG=false`.
- `DatabaseSeeder` ne crée rien par défaut ; `DemoSeeder` ne s'exécute jamais automatiquement.
- Formulaire de contact testé de bout en bout avec Resend (envoi réel vérifié).
- Assets front déjà compilés dans `public/build/` (`npm run build`).

**À faire avant une mise en ligne réelle :**

1. **Variables d'environnement de production**, sur le serveur uniquement :
   - `APP_ENV=production` et `APP_DEBUG=false` (sinon les erreurs affichent la stacktrace complète publiquement) ;
   - `APP_URL=https://gnahoui.alwaysdata.net` (URL réelle, en HTTPS) ;
   - `SESSION_SECURE_COOKIE=true` (cookie de session envoyé uniquement en HTTPS) ;
   - une **nouvelle** `APP_KEY` générée sur le serveur (`php artisan key:generate`), différente de celle utilisée en local.
2. **Base de données** : SQLite convient pour un trafic de portfolio, mais vérifie que l'hébergeur choisi persiste bien le fichier `database/database.sqlite` entre deux déploiements (certains PaaS ont un système de fichiers éphémère qui l'efface à chaque déploiement — dans ce cas, passer à MySQL/PostgreSQL managé).
3. **Après le premier déploiement**, sur le serveur :
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=AdminUserSeeder
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```
4. **Mot de passe admin réel** : remplace le placeholder dans `AdminUserSeeder.php` par le vrai mot de passe avant de seeder en prod (ou seed avec le placeholder puis change-le immédiatement via `/profile`) — ne jamais commiter un vrai mot de passe.
5. **Domaine Resend** : `onboarding@resend.dev` suffit tant que le formulaire de contact n'envoie qu'à ta propre adresse (`CONTACT_NOTIFICATION_EMAIL`). Si tu veux un jour répondre automatiquement aux visiteurs, il faudra vérifier un domaine sur Resend et adapter `MAIL_FROM_ADDRESS`.
6. **Reverse proxy / HTTPS** : si l'hébergeur place l'app derrière un load balancer ou reverse proxy, configurer `trustProxies` dans `bootstrap/app.php` pour que Laravel détecte correctement le HTTPS (sinon des redirections en boucle ou des liens en `http://` peuvent apparaître).
7. **Historique Git** : le dépôt local n'a pour l'instant qu'un commit initial (scaffold Breeze) — tout le travail réalisé depuis (thème, redesign, CRUD, emails, pages d'erreur…) n'est pas encore commité ni poussé vers un dépôt distant.

## Structure

- **Site public** : `/`, `/parcours-projets`, `/parcours-projets/{slug}`, `/articles-contact` — contrôleurs `ProfilController`, `ParcoursProjetsController`, `ArticlesContactController`, `ContactController`.
- **Dashboard admin** : tout sous `/admin`, protégé par le middleware `auth` — contrôleurs dans `app/Http/Controllers/Admin/`, CRUD complet (Projets, Compétences, Parcours, Articles, Candidatures) via `Route::resource`. Après connexion ou déconnexion, les redirections pointent vers `admin.dashboard` / `login` (la route `dashboard` héritée du scaffold Breeze a été retirée du projet, ainsi que toutes ses références résiduelles).
- **Composants Blade réutilisables** (`resources/views/components/`) :
  - `navbar`, `burger-menu`, `footer` — navigation et pied de page du site public (liens de réseaux à éditer dans `footer.blade.php`)
  - `pill-button` — bouton pilule ; props `variant` (`dark`/`light`/`outline`) et `icon` (`arrow`/`github`/`link`)
  - `tag`, `section-label` (props `size` : `sm`/`lg`), `carousel-nav` (flèches + points de pagination réutilisés par les carrousels)
- **Page Profil** (`resources/views/profil/index.blade.php`) : Hero (photo `public/images/AvatarL.jpg`), Services, À propos ("Ma méthode" + statistiques), Compétences — contenu texte centralisé dans les constantes de `ProfilController` (`NAME`, `JOB_TITLE`, `BIO`, `SERVICES`, `ABOUT_DESCRIPTION`, `APPROACH`, `STATS`), facile à éditer.
- **Carrousels** : la liste de projets (page Parcours & Projets) passe en carrousel 2 par page sur mobile uniquement (la grille desktop reste complète) ; la liste d'articles passe en carrousel sur les deux formats (4 par page en desktop, 2 par page en mobile).
