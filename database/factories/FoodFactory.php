<?php

use Faker\Generator as Faker;

$factory->define(App\Food::class, function (Faker $faker) {
    $foodImageDir = public_path('images/food');
    $foodImages = array_filter(scandir($foodImageDir), function ($file) use ($foodImageDir) {
        return !is_dir($foodImageDir . '/' . $file);
    });

    $randomImage = $faker->randomElement($foodImages);

    return [
        'restaurant_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 5),
        'food_name' => $faker->word,
        'price' => $faker->numberBetween(100, 999),
        'picture' => $randomImage, // relative path
    ];
});
