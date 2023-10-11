<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $routes = [
            'ML',
            'LM',
            'LS',
            'SL',
        ];

        return [
            'car_id' => \App\Models\Car::factory(),
            'route' => $this->faker->randomElement($routes),
            'departure_time' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'arrival_time' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
            'price' => $this->faker->numberBetween(100000, 200000),
            'available_seats' => $this->faker->numberBetween(1, 10),
        ];
    }
}
