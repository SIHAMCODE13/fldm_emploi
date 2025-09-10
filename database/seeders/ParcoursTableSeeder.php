<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcoursTableSeeder extends Seeder
{
    public function run()
    {
        $parcours = [
            ['code_parcours' => 101, 'parcours' => 'Langue et Littérature Arabes', 'parcours_ar' => 'اللغة والأدب العربي', 'id_filiere' => 1],
            ['code_parcours' => 102, 'parcours' => 'Langue et Littérature Françaises', 'parcours_ar' => 'اللغة والأدب الفرنسي', 'id_filiere' => 2],
            ['code_parcours' => 103, 'parcours' => 'Langue et Littérature Anglaises', 'parcours_ar' => 'اللغة والأدب الإنجليزي', 'id_filiere' => 3],
            ['code_parcours' => 104, 'parcours' => 'Histoire et Civilisation', 'parcours_ar' => 'التاريخ والحضارة', 'id_filiere' => 4],
            ['code_parcours' => 105, 'parcours' => 'Géographie', 'parcours_ar' => 'الجغرافيا', 'id_filiere' => 5],
            ['code_parcours' => 106, 'parcours' => 'Philosophie', 'parcours_ar' => 'الفلسفة', 'id_filiere' => 6],
            ['code_parcours' => 107, 'parcours' => 'Sociologie', 'parcours_ar' => 'علم الاجتماع', 'id_filiere' => 7],
            ['code_parcours' => 108, 'parcours' => 'Psychologie', 'parcours_ar' => 'علم النفس', 'id_filiere' => 8],
        ];

        DB::table('parcours')->insert($parcours);
    }
}