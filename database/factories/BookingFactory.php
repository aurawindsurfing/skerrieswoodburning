<?php

use Faker\Generator as Faker;

$factory->define(App\Booking::class, function (Faker $faker) {

    $course = App\Course::all()->random();
    $bookingDate = $faker->dateTimeBetween($startDate = $course->date .' -4 weeks', $endDate = $course->date .' -1 days', $timezone = 'Europe/Dublin');
    $company = App\Company::all(['id'])->random();

    $fake_or_false_company = $faker->randomElement([$company, null]);


    return [
        'date' => $bookingDate,
        'course_id' => $course->id,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'phone' => $faker->randomElement(['0862194744','0868065966']),
        'email' => $faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
        'pps' => $faker->boolean,
        'rate' => $faker->randomElement([85,95,100,115]),
        'company_id' => $fake_or_false_company,
        'contact_id' => $fake_or_false_company ? $fake_or_false_company->contacts->first() : null,
        'po' => $faker->optional()->randomNumber,
        'confirmation_sent' => now(),
        'reminder_sent' => date('Y-m-j H:m:s', strtotime($course->date.' -3 days')),
        'confirmed' => $faker->boolean,
        'no_show' => $faker->boolean,
        'user_id' => $faker->optional()->randomElement(App\User::all(['id'])),
        'comments' => $faker->optional()->text,
        'created_at' => $bookingDate,
        'updated_at' => $bookingDate,
    ];
});