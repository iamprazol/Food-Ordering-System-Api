<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(1, True),
        'food_id' => $faker->numberBetween(1, 10),
        'quantity' => $faker->numberBetween(1, 50),
        'address_id' => $faker->numberBetween(1, 10),
        'delivery_date' => $faker->date('Y-m-d', 'now'),
        'delivery_time' => $faker->time('H:i', 'now'),
        'instruction' => $faker->sentence,
        'total_price' => $faker->randomNumber(3, True),
        'paid' => $faker->boolean,
    ];
});
