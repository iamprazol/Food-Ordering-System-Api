<?php

use Faker\Generator as Faker;

$factory->define(App\Restaurant::class, function (Faker $faker) {
    return [
        'restaurant_name' => $faker->sentence(1),
        'address' => $faker->sentence(1),
        'description' => $faker->paragraph(mt_rand(2,6),True),
        'delivery_hours' => $faker->sentence(1),
        'minimum_order' => $faker->randomNumber(3,True),
        'cover_pic' => $faker->imageUrl(200, 100),
        'picture' => $faker->imageUrl(200, 100),
    ];
});
