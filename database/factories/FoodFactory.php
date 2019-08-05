<?php

use Faker\Generator as Faker;

$factory->define(App\Food::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->randomNumber(1, True),
        'category_id' => $faker->randomNumber(1, True),
        'food_name' => $faker->name,
        'price' => $faker->randomNumber(3, True),
        'picture' => $faker->imageUrl(200, 100),
    ];
});
