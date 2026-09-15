<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Ne crée pas de compte de test par défaut : le compte admin unique est créé
     * volontairement via `php artisan db:seed --class=AdminUserSeeder` (voir README).
     * Les données de démonstration s'ajoutent de la même façon avec DemoSeeder.
     */
    public function run(): void
    {
        //
    }
}
