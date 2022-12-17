<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        return [
            'category_no' => $this->faker->name(),
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(1),
        ];
    }
}
