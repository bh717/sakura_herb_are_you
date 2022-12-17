<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductTaste;
use App\Models\Taste;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTasteFactory extends Factory
{
    protected $model = ProductTaste::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'taste_id' => Taste::factory(),
        ];
    }
}
