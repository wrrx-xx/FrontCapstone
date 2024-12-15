<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Amenities;
use App\Models\Photos;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class ListingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create multiple listings
        for ($i = 0; $i < 10; $i++) { // Change 10 to however many listings you want to create
            // Create a sample listing
            $listing = Listing::create([
                'owner_id' => 1, // Assuming you have a user with ID 1
                'title' => $faker->sentence(3),
                'body' => $faker->paragraph(),
                'price' => $faker->randomFloat(2, 500, 5000), // Random price between 500 and 5000
                'address' => $faker->address,
                'baranggay' => $faker->word,
                'city' => $faker->city,
                'type' => $faker->randomElement(['Apartment', 'House', 'Boarding house', 'Room']),
                'availability' => $faker->randomElement(['open', 'closed']),
                'reservation' => $faker->randomElement(['open', 'closed']),
                'reservation_amount' => $faker->randomFloat(2, 100, 1000), // Random reservation amount between 100 and 1000
            ]);

            // Create amenities for the listing
            Amenities::create([
                'listing_id' => $listing->id,
                'wifi' => $faker->boolean,
                'parking' => $faker->boolean,
                'bathroom' => $faker->boolean,
                'kitchen' => $faker->boolean,
                'laundry' => $faker->boolean,
                'gym' => $faker->boolean,
                'projector_room' => $faker->boolean,
                'back_yard' => $faker->boolean,
                'front_yard' => $faker->boolean,
                'attached_garage' => $faker->boolean,
                'pool' => $faker->boolean,
                'elevator' => $faker->boolean,
                'school' => $faker->boolean,
                'transportation_hub' => $faker->boolean,
                'super_market' => $faker->boolean,
                'clinic' => $faker->boolean,
            ]);

            // Create sample photos for the listing
            for ($j = 0; $j < 3; $j++) { // Change 3 to however many photos you want per listing
                Photos::create([
                    'listing_id' => $listing->id,
                    'photo_url' => 'photos/photo' . rand(1, 10) . '.jpg', // Random photo path
                ]);
            }
        }
    }
}