<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $sampleReviews = [
            "Amazing food and great ambiance. Highly recommend!",
            "The service was slow but the food made up for it.",
            "Best restaurant in town! Will visit again.",
            "Quality could be better, but overall a decent experience.",
            "Delicious dishes and friendly staff.",
            "Portions are small for the price.",
            "Loved the flavor and presentation.",
            "Not up to my expectations, but still okay.",
            "A hidden gem with authentic taste.",
            "Perfect place for family dinners.",
            "Average food, but great location.",
            "Fast delivery and fresh ingredients.",
            "I enjoyed every bite, especially the desserts.",
            "Could improve on cleanliness.",
            "Staff were courteous and attentive.",
        ];

        $totalReviews = 100;

        for ($i = 0; $i < $totalReviews; $i++) {
            DB::table('reviews')->insert([
                'user_id' => $faker->numberBetween(1, 10),
                'restaurant_id' => $faker->numberBetween(1, 15),
                'name' => $faker->name,
                'review' => $faker->randomElement($sampleReviews),
                'rating' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
