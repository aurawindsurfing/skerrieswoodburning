<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    $invoice = App\Invoice::all(['id'])->random();
    // $booking = App\Booking::all(['id'])->random();

    return [
        'amount' => $faker->randomElement([10, 30, 45, 35, 55, 65, 70]),
        'payment_method' => $faker->randomElement(['cc', 'eft', 'cash', 'cheque']),
        'status' => $faker->randomElement(['completed', 'cancelled']),
        'invoice_id' => $invoice->id,
        // 'booking_id' => $booking
    ];
});
