<?php

namespace Database\Factories;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;

class TherapistFactory extends Factory
{
    protected $model = Therapist::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'last_name_kana' => $this->faker->kanaName(),
            'first_name_kana' => $this->faker->kanaName(),
            'birthday' => $this->faker->dateTimeBetween($startDate = '-70 years', $max = '-10 years')->format('Y-m-d'),
            'zip' => $this->faker->postcode(),
            'address1' => $this->faker->address(),
            'tel1' => $this->faker->phoneNumber(),
        ];
    }
}
