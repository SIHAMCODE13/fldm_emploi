<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupeUsersTableSeeder extends Seeder
{
    public function run()
    {
        $groupeUsers = [
            ['annee_scolaire' => '2024', 'id_groupe' => 1, 'id_users' => 4], // Mohammed Karim dans Groupe A LLA S1
            ['annee_scolaire' => '2024', 'id_groupe' => 2, 'id_users' => 5], // Amina Touzani dans Groupe B LLA S1
        ];

        DB::table('groupe_users')->insert($groupeUsers);
    }
}