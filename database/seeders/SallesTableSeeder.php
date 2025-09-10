<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SallesTableSeeder extends Seeder
{
    public function run()
    {
        $salles = [
            ['nom_salle' => 'Salle 1', 'capacite' => 50, 'disponibilite' => true],
            ['nom_salle' => 'Salle 2', 'capacite' => 60, 'disponibilite' => true],
            ['nom_salle' => 'Salle 3', 'capacite' => 40, 'disponibilite' => true],
            ['nom_salle' => 'Amphi A', 'capacite' => 150, 'disponibilite' => true],
            ['nom_salle' => 'Amphi B', 'capacite' => 200, 'disponibilite' => true],
        ];

        DB::table('salles')->insert($salles);
    }
}