<?php

namespace Database\Factories;

use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;

    public function definition(): array
    {
        $price = $this->faker->numberBetween($min = 1, $max = 2000);
        return [
            'product_id' => Product::factory(),
            'capacity' => $this->faker->lexify('LEAF') . $this->faker->numberBetween($min = 0, $max = 200) . 'g',
            'price' => $this->faker->numberBetween($min = 1, $max = 2000),
            'include_tax' => $price - ($price / 1.1),
            'sort_order' => $this->faker->randomNumber(1),
        ];
    }
}
