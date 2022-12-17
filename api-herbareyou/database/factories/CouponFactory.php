<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'name' => 'お試しクーポン' . $this->faker->randomNumber(1),
            'code' => 'c-000' . $this->faker->randomNumber(1),
            'discount_price' => $this->faker->numberBetween($min = 1, $max = 100),
            'expired_at' => $this->faker->dateTimeBetween($startDate = 'now', $max = '+1 years')->format('Y-m-d H:i:s')
        ];
    }
}
