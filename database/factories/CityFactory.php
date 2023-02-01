<?php

namespace Database\Factories;

use Domains\City\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city,
            'lat' => fake()->latitude,
            'lon' => fake()->longitude,
        ];
    }
}
