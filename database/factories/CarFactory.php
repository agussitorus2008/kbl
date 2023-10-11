<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $drivers = \App\Models\Driver::pluck('id')->toArray();
        // capacity antara 9 dan 12
        return [
            'driver_id' => $this->faker->randomElement($drivers),
            'capacity' => $this->faker->numberBetween(1, 10),
            'car_number' => $this->faker->unique()->numberBetween(1, 100),
            'plate_number' => $this->faker->unique()->bothify('??-####-??'),
            'type' => $this->faker->randomElement(['executive', 'non-executive']),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
