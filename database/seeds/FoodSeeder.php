<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FoodSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $foods = [
            ['name' => 'Margherita Pizza', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            ['name' => 'Cheeseburger', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            ['name' => 'Butter Chicken', 'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'],
            ['name' => 'Sushi Platter', 'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'],
            ['name' => 'Pasta Carbonara', 'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'],
            ['name' => 'Tandoori Chicken', 'image' => 'https://images.unsplash.com/photo-1625942452220-87a9c56c3c4f'],
            ['name' => 'Vegan Buddha Bowl', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'],
            ['name' => 'Fish and Chips', 'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'],
            ['name' => 'Falafel Wrap', 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'],
            ['name' => 'Chicken Caesar Salad', 'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'],
            ['name' => 'Biryani', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            ['name' => 'Ramen', 'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'],
            ['name' => 'Grilled Steak', 'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'],
            ['name' => 'Shawarma Plate', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            ['name' => 'Pad Thai', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            ['name' => 'Dim Sum', 'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'],
            ['name' => 'Veggie Sandwich', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'],
            ['name' => 'Lamb Kebab', 'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'],
            ['name' => 'Chocolate Cake', 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'],
            ['name' => 'Mango Smoothie', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'],
            [
                'name' => 'Beef Tacos',
                'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'
            ],
            [
                'name' => 'Seafood Paella',
                'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'
            ],
            [
                'name' => 'Egg Fried Rice',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'name' => 'Miso Soup',
                'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'
            ],
            [
                'name' => 'Greek Salad',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'
            ],
            [
                'name' => 'Chicken Satay',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'
            ],
            [
                'name' => 'Pho Bo',
                'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'
            ],
            [
                'name' => 'Korean Bibimbap',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'name' => 'French Onion Soup',
                'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'
            ],
            [
                'name' => 'Caprese Salad',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'
            ],
            [
                'name' => 'Poutine',
                'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'
            ],
            [
                'name' => 'Macaroni & Cheese',
                'image' => 'https://images.unsplash.com/photo-1553621042-f6e147245754'
            ],
            [
                'name' => 'Club Sandwich',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'
            ],
            [
                'name' => 'Chicken Wings',
                'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90'
            ],
            [
                'name' => 'Gnocchi',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd'
            ],
            [
                'name' => 'Chicken Alfredo',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38'
            ],
            [
                'name' => 'Cobb Salad',
                'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'
            ],
            [
                'name' => 'Thai Green Curry',
                'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349'
            ],
            [
                'name' => 'Teriyaki Chicken Bowl',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836'
            ],
            [
                'name' => 'Avocado Toast',
                'image' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141'
            ],

        ];

        foreach ($foods as $food) {
            DB::table('foods')->insert([
                'restaurant_id' => $faker->numberBetween(1, 15), // Adjust as needed
                'category_id' => $faker->numberBetween(1, 15),    // Adjust as needed
                'food_name' => $food['name'],
                'picture' => $food['image'],
                'price' => $faker->randomFloat(2, 80, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
