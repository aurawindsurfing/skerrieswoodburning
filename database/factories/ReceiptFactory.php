<?php

use Faker\Generator as Faker;

$factory->define(App\Receipt::class, function (Faker $faker) {

    $payment = App\Payment::all(['id'])->random();

    return [
        'payment_id' => $payment
    ];
});
