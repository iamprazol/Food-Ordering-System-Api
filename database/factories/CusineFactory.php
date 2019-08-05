<?php

use Faker\Generator as Faker;

$factory->define(App\Cusine::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
