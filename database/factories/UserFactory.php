<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('vi_VN');
        return [
            'fullname' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'code' => rand(999, 9999),
            'phone_number' => rand(100000000, 999999999),
            'day_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $faker->address(),
            'level' => Arr::random(['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']),
            'department_id' => Department::inRandomOrder()->first()->id
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
