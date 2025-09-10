<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupeModelesTableSeeder extends Seeder
{
    public function run()
    {
        $groupeModules = [
            ['id_module' => 1, 'id_groupe' => 1], // Grammaire arabe pour Groupe A LLA S1
            ['id_module' => 2, 'id_groupe' => 1], // Littérature arabe classique pour Groupe A LLA S1
            ['id_module' => 4, 'id_groupe' => 3], // Linguistique française pour Groupe A LLF S1
            ['id_module' => 7, 'id_groupe' => 4], // Histoire ancienne pour Groupe A Histoire S3
        ];

        DB::table('groupe_modele')->insert($groupeModules);
    }
}