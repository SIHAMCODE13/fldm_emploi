<?php

namespace Database\Factories;

use App\Models\Salle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salle>
 */
class SalleFactory extends Factory
{
    protected $model = Salle::class;

    public function definition(): array
    {
        return [
            'id_salle' => $this->faker->unique()->numberBetween(1, 1000),
            'nom_salle' => $this->faker->numerify('Salle ##'), // Ex. : "Salle A1"
            'capacite' => $this->faker->numberBetween(20, 100), // Capacité entre 20 et 100
            'disponibilite' => $this->faker->boolean, // true ou false
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}