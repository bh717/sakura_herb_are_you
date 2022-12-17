<?php

namespace Database\Factories;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymptomFactory extends Factory
{
    protected $model = Symptom::class;

    public function definition(): array
    {
        return [
            'category_no' => $this->faker->name(),
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(1),
        ];
    }
}
