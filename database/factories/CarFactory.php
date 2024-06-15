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
        return [
            'capacity' => rand(9, 11),
            'car_number' => $this->faker->randomNumber(4, true),
            'plate_number' => $this->faker->randomNumber(4, true),
            'type' => $this->faker->randomElement(['executive', 'non-executive']),
            'image' => $this->faker->imageUrl(640, 480),
        ];
    }
}
