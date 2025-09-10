<?php

namespace Database\Factories;

use App\Models\Semistre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Semistre>
 */
class SemistreFactory extends Factory
{
    protected $model = Semistre::class;

    public function definition(): array
    {
        return [
            'id_semestre' => $this->faker->unique()->numberBetween(1, 1000),
            'nom_semestre' => $this->faker->randomElement(['S1', 'S2', 'S3', 'S4', 'S5', 'S6']),
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}