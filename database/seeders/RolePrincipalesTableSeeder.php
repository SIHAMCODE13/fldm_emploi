<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePrincipalesTableSeeder extends Seeder
{
    public function run()
    {
        $rolePrincipales = [
            ['id_role' => 1, 'id_user' => 1, 'role_principale' => true], // Admin
            ['id_role' => 2, 'id_user' => 2, 'role_principale' => true], // Enseignant
            ['id_role' => 2, 'id_user' => 3, 'role_principale' => true], // Enseignant
            ['id_role' => 3, 'id_user' => 4, 'role_principale' => true], // Étudiant
            ['id_role' => 3, 'id_user' => 5, 'role_principale' => true], // Étudiant
        ];

        DB::table('role_principale')->insert($rolePrincipales);
    }
}