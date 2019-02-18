<?php

use Faker\Generator as Faker;

$factory->define(App\Cart::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(1, True),
        'restaurant_id' => $faker->randomNumber(1, True),
        'food_id' => $faker->randomNumber(1, True),
        'price' => $faker->randomNumber(3, True),
    ];
});
?>
