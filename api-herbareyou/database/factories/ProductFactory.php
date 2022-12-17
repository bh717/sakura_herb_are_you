<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_category_id' => ProductCategory::factory(),
            'product_no' => $this->faker->lexify('商品_no_???'),
            'name1' => $this->faker->lexify('商品名_???'),
            'name2' => $this->faker->lexify('商品名_???'),
            'description' => $this->faker->realText(),
            'is_public' => 1,
        ];
    }
}
