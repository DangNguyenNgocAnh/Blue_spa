<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
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
            'fullname' => Arr::random(['Nguyễn', 'Đặng', 'Hoàng', 'Trần', 'Phạm', 'Lê', 'Tôn', 'Đỗ', 'Bùi', 'Huỳnh', 'Hồ', 'Ngô'])
                . ' ' . Arr::random(['Văn', 'Thị', 'Ngọc', 'Minh', 'Hoàng', 'Hữu', 'Thành', 'Văn', 'Hữu', 'Bá', 'Thế', 'Xuân', 'Tấn'])
                . ' ' . Arr::random(['An', 'Anh', 'Ân', 'Chiến', 'Công', 'Nhi', 'Minh', 'Hân', 'Vi', 'Quỳnh', 'Mai', 'Thanh', 'Linh', 'Nghĩa', 'Nguyệt', 'Quyết', 'Tiên', 'Thắm']),
            'email' => $faker->unique()->safeEmail(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'code' => rand(1000, 9999),
            'phone_number' => $faker->numerify('0#########'),
            'day_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $faker->city,
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
