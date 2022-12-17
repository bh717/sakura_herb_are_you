<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        return [
            'series_name' => $this->faker->name(),
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(1),
        ];
    }
}
