<?php

use Faker\Generator as Faker;

$factory->define(App\Booking::class, function (Faker $faker) {

    $course = App\Course::all()->random();
    $bookingDate = $faker->dateTimeBetween($startDate = $course->date .' -4 weeks', $endDate = $course->date .' -1 days', $timezone = 'Europe/Dublin');
    $company = App\Company::all(['id'])->random();

    return [
        'date' => $bookingDate,
        'client_id' => App\Client::all(['id'])->random(),
        'course_id' => $course->id,
        'company_id' => $company,
        'contact_person_id' => factory('App\ContactPerson')->create()->id,
        'po' => $faker->optional()->randomNumber,
        'invoice' => $faker->optional()->randomNumber,
        'confirmation_sent' => $bookingDate->modify('+10 minutes'),
        'reminder_sent' => date('Y-m-j H:m:s', strtotime($course->date.' -3 days')),
        'confirmed' => $faker->boolean,
        'no_show' => $faker->boolean,
        'user_id' => $faker->optional()->randomElement(App\User::all(['id'])),
        'payment_id' => factory('App\Payment')->create()->id,
        'actually_paid' => $faker->optional()->text,
        'comments' => $faker->optional()->text
    ];
});