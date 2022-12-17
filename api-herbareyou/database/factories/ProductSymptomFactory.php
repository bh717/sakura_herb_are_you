<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductSymptom;
use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSymptomFactory extends Factory
{
    protected $model = ProductSymptom::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'symptom_id' => Symptom::factory(),
        ];
    }
}
