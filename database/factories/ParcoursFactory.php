<?php

namespace Database\Factories;

use App\Models\Parcours;
use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParcoursFactory extends Factory
{
    protected $model = Parcours::class;

    public function definition()
    {
        return [
            'code_parcours' => $this->faker->unique()->word,
            'parcours' => $this->faker->word,
            'parcours_ar' => $this->faker->word,
            'id_filiere' => Filiere::factory(),
        ];
    }
}