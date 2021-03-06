<?php

use Faker\Generator as Faker;

$factory->define(App\Restaurant::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(11,12),
        'restaurant_name' => $faker->sentence(1),
        'address' => $faker->sentence(1),
        'description' => $faker->paragraph(mt_rand(2,6),True),
        'delivery_from' => $faker->time('H:i:s'),
        'delivery_to' => $faker->time('H:i:s'),
        'minimum_order' => $faker->randomNumber(3,True),
       'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
