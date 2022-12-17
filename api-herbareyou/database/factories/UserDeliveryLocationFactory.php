<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDeliveryLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDeliveryLocationFactory extends Factory
{
    protected $model = UserDeliveryLocation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'email' => $this->faker->safeEmail(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'last_name_kana' => $this->faker->kanaName(),
            'first_name_kana' => $this->faker->kanaName(),
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'zip' => $this->faker->postcode(),
            'address1' => $this->faker->address(),
            'tel1' => $this->faker->phoneNumber(),
        ];
    }
}
