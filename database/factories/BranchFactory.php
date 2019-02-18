<?php

use Faker\Generator as Faker;

$factory->define(App\Branch::class, function (Faker $faker) {
    return [
        'restaurant_id' => $faker->randomNumber(1, True),
        'branch_name' => $faker->name,
        'address' => $faker->sentence(1, True),
        'picture' => $faker->imageUrl(200,100),
    ];
});
