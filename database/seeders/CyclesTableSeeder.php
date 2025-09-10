<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CyclesTableSeeder extends Seeder
{
    public function run()
    {
        $cycles = [
            ['code_cycle' => 'L', 'cycle' => 'Licence', 'cycle_ar' => 'الإجازة'],
            ['code_cycle' => 'M', 'cycle' => 'Master', 'cycle_ar' => 'الماستر'],
            ['code_cycle' => 'D', 'cycle' => 'Doctorat', 'cycle_ar' => 'الدكتوراه'],
        ];

        DB::table('cycles')->insert($cycles);
    }
}