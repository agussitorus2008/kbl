<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \App\Models\User::role('customer')->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'code' => $this->faker->unique()->bothify('??-####-??'),
            'discount' => $this->faker->numberBetween(1, 100),
            'limit' => $this->faker->numberBetween(1, 10),
            'used' => $this->faker->boolean(),
        ];
    }
}
