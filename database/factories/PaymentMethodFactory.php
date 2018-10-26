<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['CC','invoice','cash'])
    ];
});
