<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

/**
 * Données de démonstration réalistes mais fictives, pour captures d'écran / démos.
 *
 * N'est PAS lancé automatiquement par DatabaseSeeder — à exécuter volontairement :
 * php artisan db:seed --class=DemoSeeder
 */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $skills = $this->seedSkills();
        $this->seedExperiences();
        $this->seedProjects($skills);
        $this->seedArticles();
        $this->seedJobApplications();
        $this->seedContactMessages();
    }

    protected function seedSkills(): array
    {
        $definitions = [
            'frontend' => ['JavaScript', 'Tailwind CSS', 'Alpine.js', 'Vue.js'],
            'backend' => ['PHP', 'Laravel', 'MySQL', 'API REST'],
            'devops' => ['Docker', 'Git', 'GitHub Actions', 'Linux'],
            'outils' => ['Figma', 'VS Code', 'Postman'],
        ];

        $skills = [];

        foreach ($definitions as $category => $names) {
            foreach ($names as $name) {
                $skills[$name] = Skill::firstOrCreate(
                    ['name' => $name],
                    ['category' => $category]
                );
            }
        }

        return $skills;
    }

    protected function seedExperiences(): void
    {
        $experiences = [
            [
                'company' => 'Atelier Nova',
                'role' => 'Développeur Web Freelance',
                'location' => 'Lyon',
                'start_date' => '2023-06-01',
                'end_date' => null,
                'description' => 'Conception et développement d\'applications web sur-mesure pour des clients indépendants et petites entreprises, de la maquette à la mise en production.',
            ],
            [
                'company' => 'Studio Klein',
                'role' => 'Développeur Full-Stack',
                'location' => 'Bordeaux',
                'start_date' => '2021-09-01',
                'end_date' => '2023-05-31',
                'description' => 'Développement et maintenance d\'une suite d\'outils internes en Laravel, mise en place d\'une CI/CD et migration progressive vers une architecture orientée API.',
            ],
            [
                'company' => 'WebForge',
                'role' => 'Développeur Junior',
                'location' => 'Nantes',
                'start_date' => '2020-01-15',
                'end_date' => '2021-08-31',
                'description' => 'Intégration de maquettes, correctifs et petites fonctionnalités sur des sites vitrines et e-commerce pour une agence web généraliste.',
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::firstOrCreate(
                ['company' => $experience['company'], 'role' => $experience['role']],
                $experience
            );
        }
    }

    protected function seedProjects(array $skills): void
    {
        $projects = [
            [
                'title' => 'Gestionnaire de tâches collaboratif',
                'description' => 'Application de gestion de tâches en équipe avec tableaux Kanban et notifications en temps réel.',
                'content' => "Une application pensée pour les petites équipes qui veulent suivre leurs tâches sans complexité inutile. Le tableau Kanban permet de glisser-déposer les cartes entre colonnes, chaque changement de statut envoie une notification aux membres concernés, et un historique complet reste consultable projet par projet.\n\nCôté technique, le back-end expose une API REST consommée par une interface réactive, avec une couche de permissions par rôle pour distinguer les administrateurs des simples contributeurs.",
                'demo_url' => 'https://demo.example.com/taches',
                'repo_url' => 'https://github.com/demo-portfolio/gestionnaire-taches',
                'featured' => true,
                'status' => 'published',
                'skills' => ['Laravel', 'MySQL', 'Tailwind CSS', 'Alpine.js'],
            ],
            [
                'title' => 'Vitrine e-commerce artisanale',
                'description' => 'Boutique en ligne pour un collectif d\'artisans locaux, avec paiement et gestion des stocks.',
                'content' => "Site vitrine et boutique en ligne conçu pour un collectif de cinq artisans partageant un même catalogue. Chaque artisan gère ses propres fiches produits et son stock depuis un espace dédié, pendant que les clients parcourent un catalogue unifié avec filtres par catégorie et par créateur.\n\nLe projet inclut l'intégration d'un prestataire de paiement, la génération automatique des factures, et un tableau de bord de suivi des ventes par artisan.",
                'demo_url' => 'https://demo.example.com/artisanat',
                'repo_url' => 'https://github.com/demo-portfolio/vitrine-artisanale',
                'featured' => true,
                'status' => 'published',
                'skills' => ['PHP', 'Laravel', 'JavaScript', 'MySQL'],
            ],
            [
                'title' => 'Tableau de bord analytics',
                'description' => 'Dashboard de suivi de métriques produit avec graphiques interactifs et exports personnalisés.',
                'content' => "Un tableau de bord destiné aux équipes produit pour suivre l'évolution de leurs métriques clés (activation, rétention, usage des fonctionnalités) sans dépendre d'un outil tiers payant.\n\nLes données sont agrégées via une API REST interne, affichées sous forme de graphiques interactifs, et chaque vue peut être exportée en CSV ou programmée pour un envoi automatique par email chaque semaine.",
                'demo_url' => null,
                'repo_url' => 'https://github.com/demo-portfolio/dashboard-analytics',
                'featured' => false,
                'status' => 'published',
                'skills' => ['Vue.js', 'API REST', 'Docker'],
            ],
            [
                'title' => 'Application de réservation de salles',
                'description' => 'Outil interne de réservation de salles de réunion avec calendrier partagé et rappels automatiques.',
                'content' => "Développée pour remplacer un fichier partagé devenu ingérable, cette application permet à chaque employé de réserver une salle en quelques clics, avec visualisation du planning de la semaine et détection automatique des conflits d'horaires.\n\nUn rappel est envoyé automatiquement quinze minutes avant chaque réservation, et un rapport d'occupation mensuel est généré pour l'équipe facilities.",
                'demo_url' => null,
                'repo_url' => 'https://github.com/demo-portfolio/reservation-salles',
                'featured' => false,
                'status' => 'published',
                'skills' => ['Laravel', 'MySQL', 'Alpine.js'],
            ],
        ];

        foreach ($projects as $project) {
            $skillNames = $project['skills'];
            unset($project['skills']);

            $model = Project::firstOrCreate(
                ['title' => $project['title']],
                $project
            );

            $skillIds = collect($skillNames)
                ->map(fn ($name) => $skills[$name]->id ?? null)
                ->filter()
                ->all();

            $model->skills()->sync($skillIds);
        }
    }

    protected function seedArticles(): void
    {
        $articles = [
            [
                'title' => 'Pourquoi j\'ai choisi Laravel pour mes projets freelance',
                'excerpt' => 'Retour d\'expérience sur trois ans de missions freelance avec Laravel comme socle par défaut, et les raisons qui m\'y ont fait rester.',
                'content' => "Quand j'ai commencé en freelance, j'ai testé plusieurs frameworks avant de me fixer sur Laravel. Ce qui a fait la différence, ce n'est pas une fonctionnalité isolée mais la cohérence de l'ensemble : routing, ORM, validation, files d'attente et authentification qui fonctionnent bien ensemble dès le départ.\n\nSur des missions courtes, ce gain de temps au démarrage compte double. Je passe moins de temps à assembler des briques et plus de temps sur ce qui a de la valeur pour le client.",
                'published_at' => now()->subDays(21),
            ],
            [
                'title' => 'Organiser son CSS avec Tailwind sans perdre le contrôle',
                'excerpt' => 'Quelques règles simples pour garder une base Tailwind lisible et cohérente sur un projet qui grandit.',
                'content' => "Tailwind a la réputation de produire des templates illisibles, remplis de classes utilitaires. Dans mon expérience, le problème n'est pas l'outil mais l'absence de convention.\n\nJe m'impose systématiquement une palette de couleurs et un jeu de radius définis dans la configuration plutôt que des valeurs arbitraires, et j'extrais un composant dès qu'un motif se répète plus de deux fois. Le résultat reste rapide à écrire tout en restant maintenable sur la durée.",
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($articles as $article) {
            Article::firstOrCreate(
                ['title' => $article['title']],
                $article
            );
        }
    }

    protected function seedJobApplications(): void
    {
        $jobApplications = [
            [
                'company' => 'TechNova',
                'position' => 'Développeur Backend Laravel',
                'status' => 'entretien',
                'applied_at' => now()->subDays(12),
                'salary_range' => '42-48k€',
                'offer_url' => 'https://example.com/offres/technova-backend',
                'notes' => 'Premier entretien passé le 5, second entretien technique prévu la semaine prochaine.',
            ],
            [
                'company' => 'Studio Pixel',
                'position' => 'Développeur Full-Stack',
                'status' => 'en_attente',
                'applied_at' => now()->subDays(4),
                'salary_range' => null,
                'offer_url' => 'https://example.com/offres/studio-pixel-fullstack',
                'notes' => 'Candidature envoyée via leur formulaire, pas encore de retour.',
            ],
            [
                'company' => 'DataFlow',
                'position' => 'Ingénieur Logiciel',
                'status' => 'acceptee',
                'applied_at' => now()->subDays(30),
                'salary_range' => '45-50k€',
                'offer_url' => null,
                'notes' => 'Offre acceptée, prise de poste prévue le mois prochain.',
            ],
        ];

        foreach ($jobApplications as $jobApplication) {
            JobApplication::firstOrCreate(
                ['company' => $jobApplication['company'], 'position' => $jobApplication['position']],
                $jobApplication
            );
        }
    }

    protected function seedContactMessages(): void
    {
        $messages = [
            [
                'name' => 'Camille Berthier',
                'email' => 'camille.berthier@example.com',
                'message' => 'Bonjour, je suis tombée sur votre portfolio et j\'aimerais discuter d\'un projet de refonte de site pour mon association. Avez-vous des disponibilités ce mois-ci ?',
            ],
            [
                'name' => 'Yanis Moreau',
                'email' => 'yanis.moreau@example.com',
                'message' => 'Salut, on recrute un développeur Laravel en freelance pour une mission de 3 mois. Votre profil correspond bien à ce qu\'on cherche, contactez-moi si ça vous intéresse.',
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::firstOrCreate(
                ['email' => $message['email']],
                $message
            );
        }
    }
}
