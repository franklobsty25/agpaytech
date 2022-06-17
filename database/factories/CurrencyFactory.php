<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'iso_code' => Str::random(3),
            'iso_numeric_code' => rand(1, 100),
            'common_name' => $this->faker->country(),
            'official_name' => $this->faker->country(),
            'symbol' => $this->faker->iban(),
        ];
    }
}
