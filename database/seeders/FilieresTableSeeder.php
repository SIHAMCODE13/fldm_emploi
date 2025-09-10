<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilieresTableSeeder extends Seeder
{
    public function run()
    {
        $filieres = [
            ['nom_filiere' => 'Langue et Littérature Arabes', 'id_departement' => 1],
            ['nom_filiere' => 'Langue et Littérature Françaises', 'id_departement' => 2],
            ['nom_filiere' => 'Langue et Littérature Anglaises', 'id_departement' => 3],
            ['nom_filiere' => 'Histoire et Civilisation', 'id_departement' => 4],
            ['nom_filiere' => 'Géographie', 'id_departement' => 5],
            ['nom_filiere' => 'Philosophie', 'id_departement' => 6],
            ['nom_filiere' => 'Sociologie', 'id_departement' => 6],
            ['nom_filiere' => 'Psychologie', 'id_departement' => 6],
        ];

        DB::table('filieres')->insert($filieres);
    }
}