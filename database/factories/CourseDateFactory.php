<?php

use Faker\Generator as Faker;

$factory->define(App\CourseDate::class, function (Faker $faker) {
    return [
        // 'course_id' => App\Course::all(['id'])->random(),
        'venue_id' => App\Venue::all(['id'])->random(),
        'date' => $faker->dateTimeBetween('-3 months', '+3 months'),
        'time' => $faker->randomElement(['08:00', '08:30', '09:00']),
        
    ];
});
