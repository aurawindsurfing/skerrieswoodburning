<?php

use Faker\Generator as Faker;

$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address_line_1' => $faker->streetAddress,
        // 'address_line_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        // 'county' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->e164PhoneNumber,
        'directions' => $faker->paragraphs($nb = 5, $asText = true),
        'geo' => $faker->latitude($min = 53.00, $max = 53.60).', '.$faker->longitude($min = -6.22, $max = -7.22),
    ];
});
