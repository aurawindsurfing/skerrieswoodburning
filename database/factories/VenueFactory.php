<?php

use Faker\Generator as Faker;

$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address_line_1' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->e164PhoneNumber,
        'geo' => $faker->latitude($min = 53.00, $max = 53.60).', '.$faker->longitude($min = -6.22, $max = -7.22),
        'google_maps' => 'https://goo.gl/maps/qCRAyXZQy7S2',
    ];
});
