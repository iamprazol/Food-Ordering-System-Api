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
        'details' => '[{"id":"CSBpCate2HFcNnPC","food_id":283,"food_name":"Butter Chicken","quantity":1,"price":425.56,"special_instructions":""},{"id":"NJO4fljHgkMOmthv","food_id":834,"food_name":"Chicken Wings","quantity":3,"price":668.16,"special_instructions":""}]',
        'total_price' => $faker->randomNumber(3, True),
        'paid' => $faker->boolean,
    ];
});
