<?php

namespace Database\Factories;

use App\Models\Groupe;
use App\Models\Filiere;
use App\Models\Semistre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Groupe>
 */
class GroupeFactory extends Factory
{
    protected $model = Groupe::class;

    public function definition(): array
    {
        return [
            'id_groupe' => $this->faker->unique()->numberBetween(1, 1000),
            'nom_groupe' => $this->faker->numerify('Groupe ##'), // Ex. : "Groupe 01"
            'id_filiere' => Filiere::factory(),
            'id_semestre' => Semistre::factory(),
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}