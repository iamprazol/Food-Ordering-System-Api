<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->randomNumber(1, True),
        'name' => $faker->name,
        'review' => $faker->paragraph(mt_rand(2,6), True),
    ];
});
