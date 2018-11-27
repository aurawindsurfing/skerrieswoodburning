<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'phone' => $faker->randomElement(['0862194744','0868065966']),
        'email' => $faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
        'tax' => $faker->randomNumber($nbDigits = 7, $strict = true) . $faker->randomElement(['Q','W','E','R','T','Y']),
        'payment_method' => $faker->randomElement(['CC','EFT','Cash','Cheque']),
    ];
});
