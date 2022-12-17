<?php

namespace Database\Factories;

use App\Models\Taste;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasteFactory extends Factory
{
    protected $model = Taste::class;

    public function definition(): array
    {
        return [
            'category_no' => $this->faker->name(),
            'name' => $this->faker->name(),
            'sort_order' => $this->faker->randomNumber(1),
        ];
    }
}
