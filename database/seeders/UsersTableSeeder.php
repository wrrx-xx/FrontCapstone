<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OwnerProfile;
use App\Models\TenantProfile;
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
        $owner1 = User::create([
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

        OwnerProfile::create([
            'user_id' => $owner1->id,
            'business_name' => 'John\'s Properties',
            'business_address' => '123 Main St',
            'business_phone' => '1234567890',
            'business_email' => 'john@properties.com',
            'owner_id_type' => 'Driver\'s License',
            'approved' => false,
        ]);

        $owner2 = User::create([
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

        OwnerProfile::create([
            'user_id' => $owner2->id,
            'business_name' => 'Shin\'s Rentals',
            'business_address' => '456 Elm St',
            'business_phone' => '0987654321',
            'business_email' => 'shin@rentals.com',
            'owner_id_type' => 'Passport',
            'approved' => true,
        ]);
        // Create tenant users
        $tenant1 = User::create([
            'fname' => 'john',
            'mname' => 'A.',
            'lname' => 'Smitshu',
            'email' => 'tenant5@t',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'guest',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        TenantProfile::create([
            'user_id' => $tenant1->id,
            'current_address' => '123 Tenant St',
            'employment_status' => 'Employed',
            'monthly_income' => 3000,
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '1234567890',
            'valid_id_type' => 'Passport',
            'valid_id_front_path' => 'path/to/front.jpg',
            'valid_id_back_path' => 'path/to/back.jpg',
        ]);

        $tenant2 = User::create([
            'fname' => 'Jane',
            'mname' => 'A.',
            'lname' => 'Doe',
            'email' => 'tenant2@t',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'guest',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        TenantProfile::create([
            'user_id' => $tenant2->id,
            'current_address' => '456 Tenant Ave',
            'employment_status' => 'Unemployed',
            'monthly_income' => 0,
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '0987654321',
            'valid_id_type' => 'ID Card',
            'valid_id_front_path' => 'path/to/front2.jpg',
            'valid_id_back_path' => 'path/to/back2.jpg',
        ]);
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
            'email' => 'tenant3@t',
            'phone_number' => '0987654321',
            'password' => Hash::make('123'), // Use a secure password
            'role' => 'guest',
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
            'role' => 'guest',
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
