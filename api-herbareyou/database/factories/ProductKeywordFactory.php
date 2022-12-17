<?php

namespace Database\Factories;

use App\Models\ProductKeyword;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductKeywordFactory extends Factory
{
    protected $model = ProductKeyword::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'keyword' => $this->faker->word(),
        ];
    }
}
