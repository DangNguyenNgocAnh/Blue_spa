<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apointment;
use App\Models\Category;
use App\Models\Department;
use App\Models\Package;
use App\Models\User;
use App\Models\UserPackage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::factory(6)->sequence(
            ['name' => 'Admin', 'code' => 1002],
            ['name' => 'Manager', 'code' => 1003],
            ['name' => 'Team Leader', 'code' => 1004],
            ['name' => 'Staff', 'code' => 1005],
            ['name' => 'Customer', 'code' => 1006],
            ['name' => 'Other', 'code' => 1007],

        )->create();
        User::factory(5)->sequence(
            [
                'fullname' => 'Admin',
                'phone_number' => '0702751033',
                'code' => 1001,
                'email' => 'admin@gmail.com',
                'department_id' => 1,
            ],
            [
                'fullname' => 'Nguyen Thi Mai',
                'phone_number' => '0702753433',
                'code' => 2001,
                'email' => 'manager@gmail.com',
            ],
            [
                'fullname' => 'Pham Thi Chi',
                'phone_number' => '0702323433',
                'code' => 3001,
                'email' => 'staff@gmail.com',
            ],
            [
                'fullname' => 'Hoang Ha Nhi',
                'phone_number' => '0242753433',
                'code' => 4001,
                'email' => 'customer@gmail.com',
                'department_id' => 5

            ],
            [
                'fullname' => 'Nguyen Van Yen Mai',
                'phone_number' => '0702746433',
                'code' => 5001,
                'email' => 'leader@gmail.com',
            ]
        )->create();
        User::factory(100)->create();
        Category::factory(4)->sequence(
            ['name' => 'Chăm sóc '],
            ['name' => 'Điều trị'],
            ['name' => 'Thẩm mỹ'],
            ['name' => 'Phun xăm'],

        )->create();
        Apointment::factory(20)->create();
        Package::factory(50)->create();

        UserPackage::factory(50)->create();
    }
}
