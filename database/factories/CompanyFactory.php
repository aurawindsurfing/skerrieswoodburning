<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        'corporate_client' => $faker->boolean,
        'payment_method_id' => App\PaymentMethod::all(['id'])->random()
    ];
});
