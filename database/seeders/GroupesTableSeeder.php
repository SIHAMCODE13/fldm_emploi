<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupesTableSeeder extends Seeder
{
    public function run()
    {
        $groupes = [
            // 1. Langue et Littérature Arabes
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 1, 'id_semestre' => 1],
            
            // 2. Langue et Littérature Françaises
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 2, 'id_semestre' => 2],
            
            // 3. Etudes Anglaises
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 3, 'id_semestre' => 1],
            
            // 4. Histoire
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 4, 'id_semestre' => 3],
            
            // 5. Géographie
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 5, 'id_semestre' => 1],
            
            // 6. Philosophie
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 6, 'id_semestre' => 2],
            
            // 7. Sociologie
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 7, 'id_semestre' => 1],
            
            // 8. Psychologie
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_groupe' => 'Groupe B', 'id_filiere' => 8, 'id_semestre' => 1],
            
            // 9. Communication
            ['nom_groupe' => 'Groupe A', 'id_filiere' => 9, 'id_semestre' => 1],
        ];

        DB::table('groupes')->insert($groupes);
    }
}