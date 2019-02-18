<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(1, True),
        'address' => $faker->sentence(1, True),
    ];
});
