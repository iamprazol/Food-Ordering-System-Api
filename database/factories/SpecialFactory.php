<?php

use Faker\Generator as Faker;

$factory->define(App\Special::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->randomNumber(1, True),
        'food_id' => $faker->randomNumber(1, True),
        ];
});
