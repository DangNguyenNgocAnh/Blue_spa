<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apointment;
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
            ['name' => 'Admin'],
            ['name' => 'Manager'],
            ['name' => 'Team Leader'],
            ['name' => 'Staff'],
            ['name' => 'Customer'],
            ['name' => 'Other'],

        )->create();
        User::factory(5)->sequence(
            [
                'code' => 1001,
                'email' => 'admin@gmail.com',
                'department_id' => 6
            ],
            [
                'code' => 2001,
                'email' => 'manager@gmail.com',
            ],
            [
                'code' => 3001,
                'email' => 'staff@gmail.com',
            ],
            [
                'code' => 4001,
                'email' => 'customer@gmail.com',
                'department_id' => 5

            ],
            [
                'code' => 5001,
                'email' => 'leader@gmail.com',
            ]
        )->create();
        User::factory(10)->sequence(
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
            [
                'department_id' => 5
            ],
        )->create();
        User::factory(100)->create();
        Package::factory(50)->create();
        Apointment::factory(20)->create();
        // UserPackage::factory(50)->create();
    }
}
