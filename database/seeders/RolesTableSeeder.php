<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['nom' => 'Administrateur', 'permission' => 'all'],
            ['nom' => 'Enseignant', 'permission' => 'enseignant'],
            ['nom' => 'Étudiant', 'permission' => 'etudiant'],
        ];

        DB::table('roles')->insert($roles);
    }
}