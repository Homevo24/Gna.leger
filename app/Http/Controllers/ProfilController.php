<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\View\View;

class ProfilController extends Controller
{
    /**
     * Contenu du profil, à éditer directement ici.
     */
    protected const NAME = 'développeur full-stack';

    protected const JOB_TITLE = 'Je suis Gnahoui Léger';

    protected const BIO = [
        'Mon objectif est d’écrire un code <em>propre</em>, <em>maintenable</em> et <em>compréhensible</em>, afin de rendre le processus de développement plus agréable.',
    ];

    protected const SERVICES = [
        [
            'title' => 'Développement backend',
            'description' => 'Applications web robustes en Laravel, architecture claire et bases de données bien pensées, du prototype à la mise en production.',
            'tags' => ['Laravel', 'API REST'],
        ],
        [
            'title' => 'Interfaces frontend',
            'description' => 'Interfaces sur-mesure en Blade, Tailwind CSS et Alpine.js — claires, cohérentes et agréables à utiliser.',
            'tags' => ['Blade & Tailwind', 'Alpine.js'],
        ],
        [
            'title' => 'Performance & responsive',
            'description' => 'Sites rapides et optimisés, pensés mobile-first, avec une attention particulière portée à l’accessibilité.',
            'tags' => ['Mobile-first', 'Optimisation'],
        ],
        [
            'title' => 'Intégration WordPress',
            'description' => 'Configurations WordPress légères et sur-mesure, faciles à mettre à jour, avec des mises en page évolutives et personnalisables.',
            'tags' => ['Thèmes sur-mesure', 'Mises à jour simples'],
        ],
    ];

    protected const ABOUT_DESCRIPTION = 'Je suis un développeur full-stack passionné avec une forte sensibilité design, spécialisé dans la création d’applications web robustes et d’interfaces claires. Je m’attache à comprendre les besoins réels avant de coder, pour livrer des solutions fiables, faciles à maintenir et agréables à utiliser.';

    protected const APPROACH = [
        ['number' => '01', 'label' => 'Comprendre le besoin'],
        ['number' => '02', 'label' => 'Concevoir une architecture propre'],
        ['number' => '03', 'label' => 'Livrer une expérience fiable'],
    ];

    protected const STATS = [
        ['value' => '2+', 'label' => 'Années d’expérience'],
        ['value' => '15+', 'label' => 'Projets réalisés'],
        ['value' => '5+', 'label' => 'Clients accompagnés'],
    ];

    protected const CATEGORY_LABELS = [
        'frontend' => 'Frontend',
        'backend' => 'Backend',
        'devops' => 'DevOps',
        'outils' => 'Outils',
    ];

    public function index(): View
    {
        $skillsByCategory = Skill::orderBy('name')->get()->groupBy('category');

        return view('profil.index', [
            'name' => self::NAME,
            'jobTitle' => self::JOB_TITLE,
            'bio' => self::BIO,
            'services' => self::SERVICES,
            'aboutDescription' => self::ABOUT_DESCRIPTION,
            'approach' => self::APPROACH,
            'stats' => self::STATS,
            'categoryLabels' => self::CATEGORY_LABELS,
            'skillsByCategory' => $skillsByCategory,
        ]);
    }
}
