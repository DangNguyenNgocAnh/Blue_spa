<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'level_applied' => Arr::random(['level 1', 'level 2', 'level 3', 'level 4', 'level 5']),
            'code' => rand(1000, 9999),
            'status' => Arr::random(['Coming', 'Closed', 'Pending']),
            'types' => Arr::random(['Basic', 'Standard', 'Premium', 'Trial', 'Special']),
            'description' => Str::random(10),
            'price' => rand(100000, 2000000)
        ];
    }
}
