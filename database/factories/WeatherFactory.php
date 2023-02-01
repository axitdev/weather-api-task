<?php

namespace Database\Factories;

use Domains\City\Models\City;
use Domains\Weather\Models\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Weather>
 */
class WeatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cityIds = City::all('id');
        return [
            'temp' => fake()->numberBetween(-50, 50),
            'city_id' => fake()->unique()->randomElement($cityIds),
        ];
    }
}
