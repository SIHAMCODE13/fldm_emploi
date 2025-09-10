<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Semistre;
use App\Models\Module;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeanceFactory extends Factory
{
    protected $model = \App\Models\Seance::class;

    public function definition()
    {
        return [
            'id_filiere' => Filiere::factory(),
            'id_groupe' => Groupe::factory(),
            'id_semestre' => Semistre::factory(),
            'id_module' => Module::factory(),
            'id_salle' => Salle::factory(),
            'user_id' => User::factory()->create(['id_role' => 2]),
            'jour' => $this->faker->dayOfWeek(),
            'debut' => '08:00',
            'fin' => '10:00',
            'type_seance' => $this->faker->randomElement(['Cours', 'TD', 'TP']),
        ];
    }
}