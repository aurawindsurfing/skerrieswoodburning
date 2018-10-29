<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'pps' => $faker->randomNumber($nbDigits = 7, $strict = true) . $faker->randomElement(['Q','W','E','R','T','Y']),
        'created_at' => $faker->dateTimeBetween($startDate = '-4 years', $endDate = '+1 day', $timezone = 'Europe/Dublin')
    ];
});
