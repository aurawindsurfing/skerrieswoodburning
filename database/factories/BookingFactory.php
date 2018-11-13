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
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'pps' => $faker->randomNumber($nbDigits = 7, $strict = true) . $faker->randomElement(['Q','W','E','R','T','Y']),
        'rate' => $faker->randomElement([85,95,100,115]),
        'company_id' => $fake_or_false_company,
        'contact_id' => $fake_or_false_company ? $fake_or_false_company->contacts->first() : null,
        // 'invoice_id' => factory('App\Invoice')->create()->id,
        'po' => $faker->optional()->randomNumber,
        'confirmation_sent' => $bookingDate->modify('+10 minutes'),
        'reminder_sent' => date('Y-m-j H:m:s', strtotime($course->date.' -3 days')),
        'confirmed' => $faker->boolean,
        'no_show' => $faker->boolean,
        'user_id' => $faker->optional()->randomElement(App\User::all(['id'])),
        'comments' => $faker->optional()->text,
        'created_at' => $bookingDate,
        'updated_at' => $bookingDate,
    ];
});