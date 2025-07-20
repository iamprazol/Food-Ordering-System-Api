<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BranchSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Sample branch names suffixes
        $branchTypes = ['Downtown', 'Central', 'City Center', 'West End', 'East Side', 'Uptown', 'Lakeside', 'Riverside', 'Market', 'Mall'];

        // Sample pictures for branches (food or restaurant related, from Unsplash with proper params)
        $branchPictures = [
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80', // cozy cafe
            'https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=800&q=80', // restaurant interior
            'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80', // grill restaurant
            'https://images.unsplash.com/photo-1568901346375-23c9450c58cd', // street food place
            'https://images.unsplash.com/photo-1550547660-d9450f859349', // dining tables
        ];

        for ($restaurantId = 1; $restaurantId <= 15; $restaurantId++) {
            // Create 2-4 branches per restaurant
            $branchCount = rand(2, 4);

            for ($i = 0; $i < $branchCount; $i++) {
                $branchName = $faker->company . ' ' . $faker->randomElement($branchTypes);
                $address = $faker->streetAddress . ', ' . $faker->city . ', ' . $faker->country;
                $picture = $faker->randomElement($branchPictures);

                DB::table('branches')->insert([
                    'restaurant_id' => $restaurantId,
                    'branch_name' => $branchName,
                    'address' => $address,
                    'picture' => $picture,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
