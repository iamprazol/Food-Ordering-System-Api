<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $restaurants = [
            [
                'name' => 'The Hungry Yeti',
                'cover_pic' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
                'picture' => 'https://images.unsplash.com/photo-1528605105345-5344ea20e269',
                'address' => 'Thamel, Kathmandu, Nepal',
                'latitude' => 27.7172,
                'longitude' => 85.3240
            ],
            [
                'name' => 'Everest Bites',
                'cover_pic' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
                'picture' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe',
                'address' => 'Lakeside, Pokhara, Nepal',
                'latitude' => 28.2096,
                'longitude' => 83.9856
            ],
            [
                'name' => 'New Road Eats',
                'cover_pic' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90',
                'picture' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
                'address' => 'New Road, Kathmandu, Nepal',
                'latitude' => 27.7064,
                'longitude' => 85.3096
            ],
            [
                'name' => 'Yak & Yeti Delight',
                'cover_pic' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38',
                'picture' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468',
                'address' => 'Durbarmarg, Kathmandu, Nepal',
                'latitude' => 27.7090,
                'longitude' => 85.3216
            ],
            [
                'name' => 'Mount Feast',
                'cover_pic' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90',
                'picture' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe',
                'address' => 'Pulchowk, Lalitpur, Nepal',
                'latitude' => 27.6720,
                'longitude' => 85.3182
            ],
            [
                'name' => 'Sunset Grill',
                'cover_pic' => 'https://images.unsplash.com/photo-1550547660-d9450f859349',
                'picture' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
                'address' => 'Durbarmarg, Kathmandu, Nepal',
                'latitude' => 27.7090,
                'longitude' => 85.3182
            ],
            [
                'name' => 'Spice Bazaar',
                'cover_pic' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe',
                'picture' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5',
                'address' => 'Pulchowk, Lalitpur, Nepal',
                'latitude' => 27.7090,
                'longitude' => 85.3182
            ],
            [
                'name' => 'Tokyo Dine',
                'cover_pic' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90',
                'picture' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141',
                'address' => 'New Road, Kathmandu, Nepal',
                'latitude' => 27.7090,
                'longitude' => 85.3096
            ],
            [
                'name' => 'Le Gourmet Paris',
                'cover_pic' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836',
                'picture' => 'https://images.unsplash.com/photo-1553621042-f6e147245754',
                'address' => 'New Road, Kathmandu, Nepal',
                'latitude' => 27.7090,
                'longitude' => 85.3182
            ],
            [
                'name' => 'El Mexicano',
                'cover_pic' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38',
                'picture' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836',
                'address' => 'Lakeside, Pokhara, Nepal',
                'latitude' => 28.2096,
                'longitude' => 83.9856
            ],
            [
                'name' => 'Burger Junction',
                'cover_pic' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd',
                'picture' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4',
                 'address' => 'Thamel, Kathmandu, Nepal',
                'latitude' => 27.7172,
                'longitude' => 85.3240
            ],
            [
                'name' => 'Curry Kingdom',
                'cover_pic' => 'https://images.unsplash.com/photo-1550547660-d9450f859349',
                'picture' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5',
                'address' => 'Pulchowk, Lalitpur, Nepal',
                'latitude' => 27.6720,
                'longitude' => 85.3182
            ],
            [
                'name' => 'The Greek Table',
                'cover_pic' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe',
                'picture' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092',
                'address' => 'Lakeside, Pokhara, Nepal',
                'latitude' => 28.2096,
                'longitude' => 83.9856
            ],
            [
                'name' => 'Nordic Bites',
                'cover_pic' => 'https://images.unsplash.com/photo-1527181152855-fc03fc7949c8',
                'picture' => 'https://images.unsplash.com/photo-1528605105345-5344ea20e269',
                'address' => 'Pulchowk, Lalitpur, Nepal',
                'latitude' => 27.6720,
                'longitude' => 85.3182
            ],
            [
                'name' => 'Tango Grill',
                'cover_pic' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38',
                'picture' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1',
                'address' => 'Thamel, Kathmandu, Nepal',
                'latitude' => 27.7172,
                'longitude' => 85.3240
            ],

        ];

        foreach ($restaurants as $key => $restaurant) {
            DB::table('restaurants')->insert([
                'user_id' => $faker->numberBetween(1, 10),
                'restaurant_name' => $restaurant['name'] . ' ' . $faker->companySuffix,
                'discount' => $faker->numberBetween(0, 30),
                'vat' => $faker->numberBetween(5, 15),
                'additional_charge' => $faker->numberBetween(0, 100),
                'description' => $faker->sentence(20),
                'delivery_from' => $faker->time('H:i', '10:00'),
                'delivery_to' => $faker->time('H:i', '22:00'),
                'minimum_order' => $faker->randomFloat(2, 100, 1000),
                'cover_pic' => $restaurant['cover_pic'],
                'picture' => $restaurant['picture'],
                'address' => $restaurant['address'],
                'latitude' => $restaurant['latitude'] + $faker->randomFloat(5, -0.01, 0.01),
                'longitude' => $restaurant['longitude'] + $faker->randomFloat(5, -0.01, 0.01),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
