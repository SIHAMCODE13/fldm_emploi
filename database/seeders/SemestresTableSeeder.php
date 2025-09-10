<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestresTableSeeder extends Seeder
{
    public function run()
    {
        $semestres = [
            ['nom_semestre' => 'Semestre 1'],
            ['nom_semestre' => 'Semestre 2'],
            ['nom_semestre' => 'Semestre 3'],
            ['nom_semestre' => 'Semestre 4'],
            ['nom_semestre' => 'Semestre 5'],
            ['nom_semestre' => 'Semestre 6'],
        ];

        DB::table('semistres')->insert($semestres);
    }
}