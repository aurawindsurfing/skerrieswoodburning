<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'venue_id' => App\Venue::all(['id'])->random(),
        'tutor_id' => App\Tutor::all(['id'])->random(),
        'date' => $faker->dateTimeBetween($startDate = '-1 days', $endDate = '+7 days', $timezone = 'Europe/Dublin'),
        'price' => $faker->randomElement([85, 95, 105, 115, 120]),
        'inhouse' => $faker->boolean,
        'capacity' => $faker->randomElement([20, 10, 15, 5]),
        'course_type_id' => App\CourseType::all(['id'])->random()
    ];
});
