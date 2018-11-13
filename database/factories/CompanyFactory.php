<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        'tax' => $faker->randomNumber($nbDigits = 7, $strict = true) . $faker->randomElement(['Q','W','E','R','T','Y']),
        'payment_method' => $faker->randomElement(['CC','EFT','Cash','Cheque']),
    ];
});
