<?php

namespace Database\Factories;

use App\Models\Rattrapage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RattrapageFactory extends Factory
{
    protected $model = Rattrapage::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->state(['id_role' => 2]), // Crée un enseignant (role 2)
            'date' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'), // Date future ou actuelle
            'periode' => $this->faker->randomElement(['8:30h-10:30h', '10:30h-12:30h', '14:30h-16:30h', '16:30h-18:30h']),
            'type_seance' => $this->faker->randomElement(['Cours', 'TD', 'TP']),
            'module' => $this->faker->word(),
            'groupe' => $this->faker->word(),
            'statut' => $this->faker->randomElement(['en_attente', 'approuve', 'rejete']),
            'salle_attribuee' => null, // Peut être ajusté si besoin
            'raison_refus' => $this->faker->optional()->sentence(),
        ];
    }
}