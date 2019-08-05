<?php

use Faker\Generator as Faker;

$factory->define(App\Cart::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 11),
        'food_id' => $faker->numberBetween(1, 10),
        'quantity' => $faker->numberBetween(1, 50),
        'price' => $faker->randomNumber(3, True),
    ];
});
?>
