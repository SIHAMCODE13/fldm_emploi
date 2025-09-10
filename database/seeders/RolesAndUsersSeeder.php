<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
public function run()
{
    // Mise à jour ou insertion des rôles
    DB::table('roles')->updateOrInsert(
        ['id_role' => 1],
        ['nom' => 'Administrateur', 'permission' => 'all', 'created_at' => now(), 'updated_at' => now()]
    );
    DB::table('roles')->updateOrInsert(
        ['id_role' => 2],
        ['nom' => 'Enseignant', 'permission' => 'enseignant', 'created_at' => now(), 'updated_at' => now()]
    );
    DB::table('roles')->updateOrInsert(
        ['id_role' => 3],
        ['nom' => 'Étudiant', 'permission' => 'étudiant', 'created_at' => now(), 'updated_at' => now()]
    );

    // Mise à jour ou insertion des utilisateurs
    $users = [
        ['id_user' => 0, 'nom' => 'Amina Touzani', 'email' => 'a.touzani@etu.usmba.ac.ma', 'password' => Hash::make('password'), 'id_role' => 3],
        ['id_user' => 1, 'nom' => 'Admin', 'email' => 'admin@fldm.usmba.ac.ma', 'password' => Hash::make('password'), 'id_role' => 1],
        ['id_user' => 2, 'nom' => 'Pr. Ahmed Benali', 'email' => 'a.benali@fldm.usmba.ac.ma', 'password' => Hash::make('password'), 'id_role' => 2],
        ['id_user' => 3, 'nom' => 'Pr. Fatima Zahra El Amrani', 'email' => 'fz.elamrani@fldm.usmba.ac.ma', 'password' => Hash::make('password'), 'id_role' => 2],
        ['id_user' => 4, 'nom' => 'Mohammed Karim', 'email' => 'm.karim@etu.usmba.ac.ma', 'password' => Hash::make('password'), 'id_role' => 3],
    ];

    foreach ($users as $user) {
        DB::table('users')->updateOrInsert(
            ['id_user' => $user['id_user']],
            array_merge($user, ['created_at' => now(), 'updated_at' => now()])
        );
    }

    // Mise à jour ou insertion des rôles principaux
    $rolePrincipales = [
        ['id_role' => 1, 'id_user' => 1, 'role_principale' => true],
        ['id_role' => 2, 'id_user' => 2, 'role_principale' => true],
        ['id_role' => 2, 'id_user' => 3, 'role_principale' => true],
        ['id_role' => 3, 'id_user' => 0, 'role_principale' => true],
        ['id_role' => 3, 'id_user' => 4, 'role_principale' => true],
    ];

    foreach ($rolePrincipales as $rp) {
        DB::table('role_principale')->updateOrInsert(
            ['id_role' => $rp['id_role'], 'id_user' => $rp['id_user']],
            $rp
        );
    }
}}