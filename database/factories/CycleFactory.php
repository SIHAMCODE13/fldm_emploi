<?php

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CycleFactory extends Factory
{
    protected $model = Cycle::class;

    public function definition()
    {
        return [
            'code_cycle' => $this->faker->unique()->word,
            'cycle' => $this->faker->word,
            'cycle_ar' => $this->faker->word,
        ];
    }
}