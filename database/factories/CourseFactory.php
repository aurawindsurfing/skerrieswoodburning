<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'venue_id' => App\Venue::all(['id'])->random(),
        'tutor_id' => App\Tutor::all(['id'])->random(),
        'date' => $faker->date($format = 'Y-m-d', $min = '-1 month', $max = '+2 months'),
        'time' => $faker->randomElement(['08:00', '08:30', '09:00']),
        'price' => $faker->randomElement([85, 95, 105, 115, 120]),
        'inhouse' => $faker->boolean,
        'capacity' => $faker->randomElement([20, 10, 15, 5]),
        'course_type_id' => App\CourseType::all(['id'])->random()
    ];
});
