<?php

use Faker\Generator as Faker;

$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'directions' => $faker->paragraphs($nb = 5, $asText = true),
        'geo' => $faker->latitude($min = 53.00, $max = 53.60).', '.$faker->longitude($min = -6.22, $max = -7.22),
    ];
});
