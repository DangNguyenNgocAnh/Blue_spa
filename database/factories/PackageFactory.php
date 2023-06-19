<?php

namespace Database\Factories;

use App\Models\Category;
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
            'code' => rand(100, 9999),
            'status' => Arr::random(['Coming', 'Closed', 'Pending', 'Active']),
            'types' => Arr::random(['Basic', 'Standard', 'Premium', 'Trial', 'Special']),
            'description' => Str::random(10),
            'price' => rand(100000, 2000000),
            'category_id' => Category::inRandomOrder()->first()->id
        ];
    }
}
