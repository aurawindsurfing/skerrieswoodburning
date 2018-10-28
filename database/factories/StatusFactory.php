<?php

use Faker\Generator as Faker;

$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(['new','cancelled','paid','unpaid']),
    ];
});
