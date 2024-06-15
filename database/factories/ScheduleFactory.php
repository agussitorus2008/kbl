<?php

namespace Database\Factories;

use App\Models\Car;
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
        $cars = Car::all()->pluck('id')->toArray();
        return [
            'car_id' => $this->faker->randomElement($cars),
            'route' => $this->faker->randomElement(['ML', 'LM', 'LS', 'SL']),
            'departure_time' => $this->faker->dateTime(),
            'arrival_time' => $this->faker->dateTime(),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'available_seats' => $this->faker->numberBetween(1, 10),
        ];
    }
}
