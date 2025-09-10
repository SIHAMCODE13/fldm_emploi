<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\Semistre;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = \App\Models\Module::class;

    public function definition()
    {
        return [
            'nom_module' => $this->faker->sentence(2),
            'id_filiere' => Filiere::factory(),
            'id_semestre' => Semistre::factory(),
        ];
    }
}