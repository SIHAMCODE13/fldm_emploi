<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Désactiver les contraintes de clé étrangère temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider les tables avant de les remplir
        $this->truncateTables();

        // Appeler les seeders spécifiques
        $this->call([
            CycleSeeder::class,
            RolesTableSeeder::class,
            DepartementsTableSeeder::class,
            FilieresTableSeeder::class,
            CyclesTableSeeder::class,
            FiliereCyclesTableSeeder::class,
            ParcoursTableSeeder::class,
            SemestresTableSeeder::class,
            ModulesTableSeeder::class,
            SallesTableSeeder::class,
            GroupesTableSeeder::class,
            UsersTableSeeder::class,
            GroupeModelesTableSeeder::class,
            GroupeUsersTableSeeder::class,
            JourFeriesTableSeeder::class,
            RolePrincipalesTableSeeder::class,
        ]);

        // Réactiver les contraintes de clé étrangère
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    protected function truncateTables()
    {
        $tables = [
            'roles',
            'departements',
            'filieres',
            'cycles',
            'filier_cycles',
            'parcours',
            'semistres',
            'modules',
            'salles',
            'groupes',
            'users',
            'groupe_modele',
            'groupe_users',
            'jour_feries',
            'role_principale',
            'seances',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}