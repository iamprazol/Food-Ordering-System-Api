<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 11),
        'address' => $faker->sentence(1, True),
        'address_details' => $faker->sentence(15, True),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'address_title' => $faker->sentence(3, True),
        'address_contact' => $faker->numberBetween(0, 9999999999),
        'address_alternate_contact' => $faker->numberBetween(0, 9999999999),
    ];
});
