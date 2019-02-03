<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'tutor_id' => App\Tutor::all(['id'])->random(),
        'price' => $faker->randomElement([85, 95, 105, 115, 120]),
        'inhouse' => $faker->boolean,
        'capacity' => $faker->randomElement([20, 10, 15, 5]),
        'course_type_id' => App\CourseType::all(['id'])->random()
    ];
});
