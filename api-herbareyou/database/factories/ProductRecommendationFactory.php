<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductRecommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRecommendationFactory extends Factory
{
    protected $model = ProductRecommendation::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'sort_order' => $this->faker->unoque()->randomNumber(2),
        ];
    }
}
