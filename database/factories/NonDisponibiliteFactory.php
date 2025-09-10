<?php

namespace Database\Factories;

use App\Models\NonDisponibilite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NonDisponibiliteFactory extends Factory
{
    protected $model = NonDisponibilite::class;

    public function definition()
    {
        return [
            'enseignant_id' => User::factory(),
            'date_debut' => $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'type_periode' => $this->faker->randomElement(['journee', 'periode']),
            'periode' => $this->faker->randomElement(['matin', 'apres-midi']),
            'raison' => $this->faker->sentence(),
            'statut' => $this->faker->randomElement(['en_attente', 'approuve', 'rejete']),
        ];
    }
}