<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filiere>
 */
class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition(): array
    {
        return [
            'id_filiere' => $this->faker->unique()->numberBetween(1, 1000),
            'nom_filiere' => $this->faker->words(2, true), // Ex. : "Informatique Appliquée"
            'id_departement' => Departement::factory(),
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}