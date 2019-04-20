<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 11),
        'address' => $faker->sentence(1, True),
    ];
});
