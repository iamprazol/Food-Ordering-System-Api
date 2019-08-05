<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->randomNumber(1, True),
        'category_name' => $faker->name,
    ];
});
