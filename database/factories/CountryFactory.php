<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'continent_code' => Str::upper(Str::random(2)),
            'currency_code' => Str::upper(Str::random(3)),
            'iso2_code' => Str::upper(Str::random(2)),
            'iso3_code' => Str::upper(Str::random(3)),
            'iso_numeric_code' => rand(0, 4),
            'fips_code' => Str::upper(Str::random(2)),
            'calling_code' => rand(1, 1000),
            'common_name' => $this->faker->country(),
            'official_name' => $this->faker->country(),
            'endonym' => $this->faker->country(),
            'demonym' => $this->faker->country(),
        ];
    }
}
