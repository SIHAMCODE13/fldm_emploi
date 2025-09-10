<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            // 1. Langue et Littérature Arabes
            // Semestre 1
            ['nom_module' => 'Grammaire arabe I', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_module' => 'Littérature arabe classique', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_module' => 'Morphologie', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_module' => 'Critique littéraire', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_module' => 'Rhétorique', 'id_filiere' => 1, 'id_semestre' => 1],
            ['nom_module' => 'Linguistique arabe', 'id_filiere' => 1, 'id_semestre' => 1],

            // Semestre 2
            ['nom_module' => 'Grammaire arabe II', 'id_filiere' => 1, 'id_semestre' => 2],
            ['nom_module' => 'Littérature arabe moderne', 'id_filiere' => 1, 'id_semestre' => 2],
            ['nom_module' => 'Poésie arabe', 'id_filiere' => 1, 'id_semestre' => 2],
            ['nom_module' => 'Prosodie', 'id_filiere' => 1, 'id_semestre' => 2],
            ['nom_module' => 'Dialectologie', 'id_filiere' => 1, 'id_semestre' => 2],
            ['nom_module' => 'Stylistique', 'id_filiere' => 1, 'id_semestre' => 2],

            // Semestre 3
            ['nom_module' => 'Grammaire arabe III', 'id_filiere' => 1, 'id_semestre' => 3],
            ['nom_module' => 'Littérature arabe andalouse', 'id_filiere' => 1, 'id_semestre' => 3],
            ['nom_module' => 'Analyse du discours', 'id_filiere' => 1, 'id_semestre' => 3],
            ['nom_module' => 'Sémantique', 'id_filiere' => 1, 'id_semestre' => 3],
            ['nom_module' => 'Littérature comparée', 'id_filiere' => 1, 'id_semestre' => 3],
            ['nom_module' => 'Traduction', 'id_filiere' => 1, 'id_semestre' => 3],

            // Semestre 4
            ['nom_module' => 'Grammaire arabe IV', 'id_filiere' => 1, 'id_semestre' => 4],
            ['nom_module' => 'Littérature arabe contemporaine', 'id_filiere' => 1, 'id_semestre' => 4],
            ['nom_module' => 'Poétique', 'id_filiere' => 1, 'id_semestre' => 4],
            ['nom_module' => 'Sociocritique', 'id_filiere' => 1, 'id_semestre' => 4],
            ['nom_module' => 'Littérature maghrébine', 'id_filiere' => 1, 'id_semestre' => 4],
            ['nom_module' => 'Didactique de la langue arabe', 'id_filiere' => 1, 'id_semestre' => 4],

            // Semestre 5
            ['nom_module' => 'Syntaxe avancée', 'id_filiere' => 1, 'id_semestre' => 5],
            ['nom_module' => 'Théorie littéraire', 'id_filiere' => 1, 'id_semestre' => 5],
            ['nom_module' => 'Littérature et société', 'id_filiere' => 1, 'id_semestre' => 5],
            ['nom_module' => 'Herméneutique', 'id_filiere' => 1, 'id_semestre' => 5],
            ['nom_module' => 'Littérature et critique', 'id_filiere' => 1, 'id_semestre' => 5],
            ['nom_module' => 'Sémiotique', 'id_filiere' => 1, 'id_semestre' => 5],

            // Semestre 6
            ['nom_module' => 'Linguistique textuelle', 'id_filiere' => 1, 'id_semestre' => 6],
            ['nom_module' => 'Analyse des textes littéraires', 'id_filiere' => 1, 'id_semestre' => 6],
            ['nom_module' => 'Esthétique littéraire', 'id_filiere' => 1, 'id_semestre' => 6],
            ['nom_module' => 'Littérature et idéologie', 'id_filiere' => 1, 'id_semestre' => 6],
            ['nom_module' => 'Recherche en littérature', 'id_filiere' => 1, 'id_semestre' => 6],
            ['nom_module' => 'Projet de fin d\'études', 'id_filiere' => 1, 'id_semestre' => 6],

            // 2. Langue et Littérature Françaises
            // Semestre 1
            ['nom_module' => 'Linguistique française I', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_module' => 'Littérature française du Moyen Âge', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_module' => 'Grammaire française', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_module' => 'Expression écrite', 'id_filiere' => 2, 'id_semestre' => 1],
            ['nom_module' => 'Culture générale', 'id_filiere' => 2, 'id_semestre' => 1],

            // Semestre 2
            ['nom_module' => 'Linguistique française II', 'id_filiere' => 2, 'id_semestre' => 2],
            ['nom_module' => 'Littérature du XVIe siècle', 'id_filiere' => 2, 'id_semestre' => 2],
            ['nom_module' => 'Stylistique', 'id_filiere' => 2, 'id_semestre' => 2],
            ['nom_module' => 'Analyse textuelle', 'id_filiere' => 2, 'id_semestre' => 2],
            ['nom_module' => 'Expression orale', 'id_filiere' => 2, 'id_semestre' => 2],
            ['nom_module' => 'Civilisation française', 'id_filiere' => 2, 'id_semestre' => 2],

            // Semestre 3
            ['nom_module' => 'Linguistique française III', 'id_filiere' => 2, 'id_semestre' => 3],
            ['nom_module' => 'Littérature du XVIIe siècle', 'id_filiere' => 2, 'id_semestre' => 3],
            ['nom_module' => 'Sémantique', 'id_filiere' => 2, 'id_semestre' => 3],
            ['nom_module' => 'Poétique', 'id_filiere' => 2, 'id_semestre' => 3],
            ['nom_module' => 'Littérature comparée', 'id_filiere' => 2, 'id_semestre' => 3],
            ['nom_module' => 'Traduction', 'id_filiere' => 2, 'id_semestre' => 3],

            // Semestre 4
            ['nom_module' => 'Linguistique française IV', 'id_filiere' => 2, 'id_semestre' => 4],
            ['nom_module' => 'Littérature du XVIIIe siècle', 'id_filiere' => 2, 'id_semestre' => 4],
            ['nom_module' => 'Analyse du discours', 'id_filiere' => 2, 'id_semestre' => 4],
            ['nom_module' => 'Rhétorique', 'id_filiere' => 2, 'id_semestre' => 4],
            ['nom_module' => 'Littérature francophone', 'id_filiere' => 2, 'id_semestre' => 4],
            ['nom_module' => 'Didactique du FLE', 'id_filiere' => 2, 'id_semestre' => 4],

            // Semestre 5
            ['nom_module' => 'Linguistique textuelle', 'id_filiere' => 2, 'id_semestre' => 5],
            ['nom_module' => 'Littérature du XIXe siècle', 'id_filiere' => 2, 'id_semestre' => 5],
            ['nom_module' => 'Pragmatique', 'id_filiere' => 2, 'id_semestre' => 5],
            ['nom_module' => 'Narratologie', 'id_filiere' => 2, 'id_semestre' => 5],
            ['nom_module' => 'Littérature et société', 'id_filiere' => 2, 'id_semestre' => 5],
            ['nom_module' => 'Sémiotique', 'id_filiere' => 2, 'id_semestre' => 5],

            // Semestre 6
            ['nom_module' => 'Théorie littéraire', 'id_filiere' => 2, 'id_semestre' => 6],
            ['nom_module' => 'Littérature du XXe siècle', 'id_filiere' => 2, 'id_semestre' => 6],
            ['nom_module' => 'Esthétique littéraire', 'id_filiere' => 2, 'id_semestre' => 6],
            ['nom_module' => 'Littérature et idéologie', 'id_filiere' => 2, 'id_semestre' => 6],
            ['nom_module' => 'Recherche en littérature', 'id_filiere' => 2, 'id_semestre' => 6],
            ['nom_module' => 'Projet de fin d\'études', 'id_filiere' => 2, 'id_semestre' => 6],

            // 3. Etudes Anglaises
            // Semestre 1
            ['nom_module' => 'English Grammar I', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_module' => 'Reading Comprehension', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_module' => 'Written Expression', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_module' => 'Oral Communication', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_module' => 'Introduction to Literature', 'id_filiere' => 3, 'id_semestre' => 1],
            ['nom_module' => 'British Civilization', 'id_filiere' => 3, 'id_semestre' => 1],

            // Semestre 2
            ['nom_module' => 'English Grammar II', 'id_filiere' => 3, 'id_semestre' => 2],
            ['nom_module' => 'Introduction to Linguistics', 'id_filiere' => 3, 'id_semestre' => 2],
            ['nom_module' => 'Literary Analysis', 'id_filiere' => 3, 'id_semestre' => 2],
            ['nom_module' => 'American Civilization', 'id_filiere' => 3, 'id_semestre' => 2],
            ['nom_module' => 'Translation', 'id_filiere' => 3, 'id_semestre' => 2],
            ['nom_module' => 'Research Methodology', 'id_filiere' => 3, 'id_semestre' => 2],

            // Continuer pour les semestres 3 à 6 et les autres filières...
            // (Le pattern continue de la même manière pour toutes les filières)
            
            // 4. Histoire
            // Semestre 1
            ['nom_module' => 'Introduction à l\'histoire', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_module' => 'Histoire ancienne', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_module' => 'Histoire du Maroc I', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie historique', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_module' => 'Civilisations antiques', 'id_filiere' => 4, 'id_semestre' => 1],
            ['nom_module' => 'Géographie historique', 'id_filiere' => 4, 'id_semestre' => 1],

            // 5. Géographie
            // Semestre 1
            ['nom_module' => 'Introduction à la géographie', 'id_filiere' => 5, 'id_semestre' => 1],
            ['nom_module' => 'Géomorphologie', 'id_filiere' => 5, 'id_semestre' => 1],
            ['nom_module' => 'Climatologie', 'id_filiere' => 5, 'id_semestre' => 1],
            ['nom_module' => 'Cartographie', 'id_filiere' => 5, 'id_semestre' => 1],
            ['nom_module' => 'Biogéographie', 'id_filiere' => 5, 'id_semestre' => 1],
            ['nom_module' => 'SIG I', 'id_filiere' => 5, 'id_semestre' => 1],

            // 6. Philosophie
            // Semestre 1
            ['nom_module' => 'Introduction à la philosophie', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_module' => 'Histoire de la philosophie ancienne', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_module' => 'Logique', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_module' => 'Épistémologie', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_module' => 'Philosophie morale', 'id_filiere' => 6, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie philosophique', 'id_filiere' => 6, 'id_semestre' => 1],

            // 7. Sociologie
            // Semestre 1
            ['nom_module' => 'Introduction à la sociologie', 'id_filiere' => 7, 'id_semestre' => 1],
            ['nom_module' => 'Histoire de la pensée sociologique', 'id_filiere' => 7, 'id_semestre' => 1],
            ['nom_module' => 'Sociologie générale', 'id_filiere' => 7, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie de recherche', 'id_filiere' => 7, 'id_semestre' => 1],
            ['nom_module' => 'Démographie', 'id_filiere' => 7, 'id_semestre' => 1],
            ['nom_module' => 'Psychologie sociale', 'id_filiere' => 7, 'id_semestre' => 1],

            // 8. Psychologie
            // Semestre 1
            ['nom_module' => 'Introduction à la psychologie', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_module' => 'Psychologie générale', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_module' => 'Psychologie du développement', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_module' => 'Psychologie cognitive', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie de recherche', 'id_filiere' => 8, 'id_semestre' => 1],
            ['nom_module' => 'Statistiques appliquées', 'id_filiere' => 8, 'id_semestre' => 1],

            // 9. Communication
            // Semestre 1
            ['nom_module' => 'Introduction aux sciences de la communication', 'id_filiere' => 9, 'id_semestre' => 1],
            ['nom_module' => 'Théories de la communication', 'id_filiere' => 9, 'id_semestre' => 1],
            ['nom_module' => 'Sociologie des médias', 'id_filiere' => 9, 'id_semestre' => 1],
            ['nom_module' => 'Techniques d\'expression', 'id_filiere' => 9, 'id_semestre' => 1],
            ['nom_module' => 'Culture générale', 'id_filiere' => 9, 'id_semestre' => 1],
            ['nom_module' => 'Méthodologie de recherche', 'id_filiere' => 9, 'id_semestre' => 1],
        ];

        DB::table('modules')->insert($modules);
    }
}