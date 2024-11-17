<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an owner user
        User::create([
            'fname' => 'John',
            'mname' => 'Doe',
            'lname' => 'Smith',
            'email' => 'r@r',
            'phone_number' => '1234567890',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'owner',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create an admin user
        User::create([
            'fname' => 'Jane',
            'mname' => 'A.',
            'lname' => 'Doe',
            'email' => 'admin@admin',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}