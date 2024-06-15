<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \App\Models\User::all();
        $coupons = \App\Models\Coupon::all();
        return [
            'user_id' => $this->faker->randomElement($users),
            'coupon_id' => $this->faker->randomElement($coupons),
            'code' => $this->faker->unique()->randomNumber(6),
            'total' => $this->faker->numberBetween(100000, 200000),
            'status' => $this->faker->randomElement(['pending', 'booked', 'canceled', 'rejected']),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
