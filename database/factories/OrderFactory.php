<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(1, True),
        'cart_id' => $faker->randomNumber(1, True),
        'address' => $faker->name,
        'delivery_date' => $faker->date('Y-m-d', 'now'),
        'delivery_time' => $faker->time('H:i', 'now'),
        'instruction' => $faker->sentence,
        'total_price' => $faker->randomNumber(3, True),
        'paid' => $faker->boolean,
    ];
});
