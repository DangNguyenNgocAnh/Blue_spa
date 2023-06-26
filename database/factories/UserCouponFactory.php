<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserCoupon>
 */
class UserCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })->inRandomOrder()->first()->id,
            'coupon_id' => Coupon::inRandomOrder()->first()->id,
        ];
    }
}
