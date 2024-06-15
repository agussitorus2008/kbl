<?php

namespace Database\Factories;

use App\Helpers\Helper;
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
        return [
            'code' => Helper::generate_coupon_code(),
            'discount' => 10,
            'limit' => 10,
            'used' => false
        ];
    }
}
