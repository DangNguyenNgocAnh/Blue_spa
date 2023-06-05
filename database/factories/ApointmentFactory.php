<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => rand(1, User::where('department_id', 5)->count()),
            'employee_id' => rand(1, User::whereNot('department_id', 5)->count()),
            'code' => rand(1000, 9999),
            'time' => fake()->date($format = 'Y-m-d', $min = '2023-05-18 00:00:00', $max = '+1 month'),
            'status' => Arr::random(['Completed', 'Confirmed', 'Cancelled', 'Missed']),
            'message' => Str::random(10)
        ];
    }
}
