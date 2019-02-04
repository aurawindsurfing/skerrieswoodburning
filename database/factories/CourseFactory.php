<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'tutor_id' => App\Tutor::all(['id'])->random(),
        'venue_id' => App\Venue::all(['id'])->random(),
        'date' => $faker->dateTimeBetween('-3 months', '+3 months'),
        'time' => $faker->randomElement(['08:00', '08:30', '09:00']),
        'price' => $faker->randomElement([85, 95, 105, 115, 120]),
        'inhouse' => $faker->boolean,
        'multiday' => $faker->boolean,
        'capacity' => $faker->randomElement([20, 10, 15, 5]),
        'course_type_id' => App\CourseType::all(['id'])->random()
    ];
});
