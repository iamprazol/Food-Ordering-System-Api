<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(1, True),
        'restaurant_id' => $faker->numberBetween(1, 10),
        'address_id' => $faker->numberBetween(1, 10),
        'delivery_date' => $faker->date('Y-m-d', 'now'),
        'delivery_time' => $faker->time('H:i', 'now'),
        'instruction' => $faker->sentence,
        'details' => 'a:2:{i:0;a:4:{s:9:"food_name";s:8:"Chowmine";s:8:"quantity";s:1:"2";s:12:"instructions";s:15:"Less soya sauce";s:5:"price";s:2:"50";}i:1;a:4:{s:9:"food_name";s:4:"Momo";s:8:"quantity";s:1:"3";s:12:"instructions";s:10:"More spicy";s:5:"price";s:3:"150";}}',
        'total_price' => $faker->randomNumber(3, True),
        'paid' => $faker->boolean,
    ];
});
