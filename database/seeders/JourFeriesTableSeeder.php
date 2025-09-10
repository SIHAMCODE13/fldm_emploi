<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JourFeriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('jour_feries')->truncate();

        $joursFeries = [
            ['2025-01-01', '2025-01-01', 'Civil', 'Nouvel An'],
            ['2025-01-11', '2025-01-11', 'Civil', 'Manifeste de l’Indépendance'],
            ['2025-01-14', '2025-01-14', 'Civil', 'Nouvel An Amazigh'],
            ['2025-03-31', '2025-04-01', 'Religieux', 'Aïd al‑Fitr (2 jours)'] , // lundi et mardi
            ['2025-05-01', '2025-05-01', 'Civil', 'Fête du Travail'],
            ['2025-06-07', '2025-06-08', 'Religieux', 'Aïd al‑Adha (2 jours)'], // samedi & dimanche
            ['2025-06-27', '2025-06-27', 'Religieux', 'Premier Moharram'],
            ['2025-07-30', '2025-07-30', 'Civil', 'Fête du Trône'],
            ['2025-08-14', '2025-08-14', 'Civil', 'Oued Eddahab'],
            ['2025-08-20', '2025-08-20', 'Civil', 'Révolution du Roi et du Peuple'],
            ['2025-08-21', '2025-08-21', 'Civil', 'Fête de la Jeunesse'],
            ['2025-09-05', '2025-09-05', 'Religieux', 'Mawlid Annabawi'],
            ['2025-11-06', '2025-11-06', 'Civil', 'Marche Verte'],
            ['2025-11-18', '2025-11-18', 'Civil', 'Fête de l’Indépendance'],
        ];

        foreach ($joursFeries as $jour) {
            DB::table('jour_feries')->insert([
                'date_debut'   => $jour[0],
                'date_fin'     => $jour[1],
                'type'         => $jour[2],
                'description'  => $jour[3],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
