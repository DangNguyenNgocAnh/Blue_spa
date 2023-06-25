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
            'customer_id' => User::where('department_id', 5)->inRandomOrder()->value('id'),
            'employee_id' => User::where('department_id', 4)->inRandomOrder()->value('id'),
            'code' => rand(1000, 9999),
            'time' => fake()->dateTimeBetween(now(), now()->addDays(7))->format('Y-m-d H:i:s'),
            'status' => Arr::random(['Completed', 'Confirmed', 'Cancelled', 'Missed']),
            'message' => Str::random(10)
        ];
    }
}
