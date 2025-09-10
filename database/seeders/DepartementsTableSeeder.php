<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementsTableSeeder extends Seeder
{
    public function run()
    {
        $departements = [
            ['nom' => 'Département de Langue et Littérature Arabes', 'responsable' => 'Pr. Ahmed Benali'],
            ['nom' => 'Département de Langue et Littérature Françaises', 'responsable' => 'Pr. Fatima Zahra El Amrani'],
            ['nom' => 'Département de Langue et Littérature Anglaises', 'responsable' => 'Pr. Karim Bouzidi'],
            ['nom' => 'Département d\'Histoire et Civilisation', 'responsable' => 'Pr. Hassan El Ouazzani'],
            ['nom' => 'Département de Géographie', 'responsable' => 'Pr. Amina Touzani'],
            ['nom' => 'Département de Philosophie, Sociologie et Psychologie', 'responsable' => 'Pr. Leila Berrada'],
        ];

        DB::table('departements')->insert($departements);
    }
}