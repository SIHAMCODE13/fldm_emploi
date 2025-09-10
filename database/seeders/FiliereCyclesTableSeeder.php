<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereCyclesTableSeeder extends Seeder
{
    public function run()
    {
        $filiereCycles = [
            ['id_filiere' => 1, 'id_cycle' => 1], // LLA Licence
            ['id_filiere' => 1, 'id_cycle' => 2], // LLA Master
            ['id_filiere' => 2, 'id_cycle' => 1], // LLF Licence
            ['id_filiere' => 2, 'id_cycle' => 2], // LLF Master
            ['id_filiere' => 3, 'id_cycle' => 1], // LLE Licence
            ['id_filiere' => 3, 'id_cycle' => 2], // LLE Master
            ['id_filiere' => 4, 'id_cycle' => 1], // Histoire Licence
            ['id_filiere' => 4, 'id_cycle' => 2], // Histoire Master
            ['id_filiere' => 5, 'id_cycle' => 1], // Géographie Licence
            ['id_filiere' => 5, 'id_cycle' => 2], // Géographie Master
            ['id_filiere' => 6, 'id_cycle' => 1], // Philosophie Licence
            ['id_filiere' => 6, 'id_cycle' => 2], // Philosophie Master
            ['id_filiere' => 7, 'id_cycle' => 1], // Sociologie Licence
            ['id_filiere' => 7, 'id_cycle' => 2], // Sociologie Master
            ['id_filiere' => 8, 'id_cycle' => 1], // Psychologie Licence
            ['id_filiere' => 8, 'id_cycle' => 2], // Psychologie Master
        ];

        DB::table('filier_cycles')->insert($filiereCycles);
    }
}