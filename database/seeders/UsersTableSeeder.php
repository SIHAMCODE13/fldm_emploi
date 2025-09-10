<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            // Administrateur
            [
                'name' => 'Admin',
                'email' => 'admin@fldm.usmba.ac.ma',
                'password' => Hash::make('admin123'),
                'id_role' => 1,
            ],
            
            // Enseignants
            [
                'name' => 'Pr. Ahmed Benali',
                'email' => 'a.benali@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Pr. Fatima Zahra El Amrani',
                'email' => 'fz.elamrani@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],





            [

                'name' => 'Pr. Mohamed El Fassi',
                'email' => 'm.elfassi@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Karima Bouziane',
                'email' => 'k.bouziane@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Langue et Littérature Françaises
            [
                'name' => 'Pr. Jean Dupont',
                'email' => 'j.dupont@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Sophie Martin',
                'email' => 's.martin@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Leila Berrada',
                'email' => 'l.berrada@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Etudes Anglaises
            [
                'name' => 'Pr. John Smith',
                'email' => 'j.smith@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Amina Johnson',
                'email' => 'a.johnson@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Histoire
            [
                'name' => 'Pr. Hassan El Moudden',
                'email' => 'h.elmoudden@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Samira Benchekroun',
                'email' => 's.benchekroun@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Géographie
            [
                'name' => 'Pr. Abdelkrim El Khamlichi',
                'email' => 'a.elkhamlichi@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Nadia El Ouafi',
                'email' => 'n.elouafi@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Philosophie
            [
                'name' => 'Pr. Mohammed Abed Al-Jabri',
                'email' => 'm.aljabri@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Zineb Serghini',
                'email' => 'z.serghini@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Sociologie
            [
                'name' => 'Pr. Abdessamad Dialmy',
                'email' => 'a.dialmy@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Khadija Zahi',
                'email' => 'k.zahi@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Psychologie
            [
                'name' => 'Pr. Rachid Benali',
                'email' => 'r.benali@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Salima El Amrani',
                'email' => 's.elamrani@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Communication
            [
                'name' => 'Pr. Noureddine Affaya',
                'email' => 'n.affaya@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Fatima Ezzahra El Asri',
                'email' => 'fe.elasri@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],

            // Enseignants supplémentaires
            [
                'name' => 'Dr. Youssef Charkaoui',
                'email' => 'y.charkaoui@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Dr. Amina Belahsen',
                'email' => 'a.belahsen@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            [
                'name' => 'Pr. Khalid Berrada',
                'email' => 'k.berrada@fldm.usmba.ac.ma',
                'password' => Hash::make('prof123'),
                'id_role' => 2,
            ],
            
            // Étudiants
            [
                'name' => 'Mohammed Karim',
                'email' => 'm.karim@etu.usmba.ac.ma',
                'password' => Hash::make('etudiant123'),
                'id_role' => 3,
            ],
            [
                'name' => 'Amina Touzani',
                'email' => 'a.touzani@etu.usmba.ac.ma',
                'password' => Hash::make('etudiant123'),
                'id_role' => 3,
            ],
        ];

        DB::table('users')->insert($users);
    }
}