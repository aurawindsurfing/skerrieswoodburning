<?php

use Faker\Generator as Faker;

$factory->define(App\ContactPerson::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        // 'company_id' => App\Company::all(['id'])->random()
    ];
});
