<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cycles')->insert([
            [
                'id' => 1,
                'code_cycle' => 'C-LEF',
                'cycle' => 'Licence d’Etudes Fondamentales',
                'cycle_ar' => 'الإجازة في الدراسات الأساسية',
                'created_at' => '2025-01-20 09:30:18',
                'updated_at' => '2025-01-20 09:30:18',
            ],
            [
                'id' => 2,
                'code_cycle' => 'C-MA',
                'cycle' => 'Master',
                'cycle_ar' => 'الماستر',
                'created_at' => '2025-01-20 09:30:18',
                'updated_at' => '2025-01-20 09:30:18',
            ],
            [
                'id' => 3,
                'code_cycle' => 'C-LE',
                'cycle' => 'licence d\'excellence',
                'cycle_ar' => 'إجازة التميز',
                'created_at' => '2025-01-20 09:30:18',
                'updated_at' => '2025-01-20 09:30:18',
            ],
            [
                'id' => 4,
                'code_cycle' => 'C-MS',
                'cycle' => 'Master spécialisé',
                'cycle_ar' => 'ماستر متخصص',
                'created_at' => '2025-01-20 09:30:18',
                'updated_at' => '2025-01-20 09:30:18',
            ],
        ]);
    }
}
