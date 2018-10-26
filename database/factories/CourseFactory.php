<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'venue_id' => App\Venue::all(['id'])->random(),
        'tutor_id' => App\Venue::all(['id'])->random(),
        'date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '+3 months', $timezone = 'Europe/Dublin'),
        'inhouse' => $faker->boolean,
        'capacity' => $faker->randomElement([20, 10, 15, 5]),
        'course_type_id' => App\CourseType::all(['id'])->random()
    ];
});
