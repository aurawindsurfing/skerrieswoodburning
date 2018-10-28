<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'rate' => $faker->randomElement([85,95,100,115]),
        'payment_method_id' => App\PaymentMethod::all(['id'])->random(),
        'status_id' => factory('App\Status')->create()->id,
    ];
});
