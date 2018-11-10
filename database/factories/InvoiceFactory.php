<?php

use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {

    $booking = App\Booking::all()->random();
    $company = App\Company::all(['id'])->random();

    return [
        'prefix' => 'N-',
        'date' => $booking->date,
        'company_id' => $company,
        'total' => $booking->rate,
        'status' => $faker->randomElement(['paid','unpaid','cancelled']), 
    ];
});