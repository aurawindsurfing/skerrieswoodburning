<?php

use Faker\Generator as Faker;

$factory->define(App\CourseType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Safepass', 'Confined Spaces', 'Manual Handling', 'CSCS Teleporter', 'CSCS Digger', 'Power Pallet Truck', 'Spill Kit']),
        'title' => 'SOLAS',
        'objectives' => $faker->sentence($nbWords = 16),
        'who_should_attend' => $faker->sentence($nbWords = 8),
        'delegates' => $faker->sentence($nbWords = 8),
        'outline' => $faker->paragraphs($nb = 5, $asText = true),
        'duration' => $faker-> sentence($nbWords = 4),
        'certification' => $faker->paragraphs($nb = 2, $asText = true),
        'what_to_bring' => $faker->sentence($nbWords = 4),
        'plan_of_the_day' => $faker->paragraphs($nb = 3, $asText = true),
        'valid_for_years' => $faker->randomElement([4,3,5]),
        'capacity' => $faker->randomElement([5,10,15,20]),
    ];
});
