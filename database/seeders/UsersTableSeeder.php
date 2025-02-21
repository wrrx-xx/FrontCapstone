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
            'email' => 'owner1@own',
            'phone_number' => '1234567890',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'owner',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'fname' => 'Shin',
            'mname' => 'Doe',
            'lname' => 'Tense',
            'email' => 'owner2@own',
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
        User::create([
            'fname' => 'john',
            'mname' => 'A.',
            'lname' => 'Smitshu',
            'email' => 'tenant1@t',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'tenant',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        User::create([
            'fname' => 'Jane',
            'mname' => 'A.',
            'lname' => 'Doe',
            'email' => 'tenant@t',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'tenant',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        User::create([
            'fname' => 'shin',
            'mname' => 'A.',
            'lname' => 'tene',
            'email' => 'caretaker1@c',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'caretaker',
            'owner_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'fname' => 'jomar',
            'mname' => 'A.',
            'lname' => 'myr',
            'email' => 'caretaker2@c',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'caretaker',
            'owner_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}