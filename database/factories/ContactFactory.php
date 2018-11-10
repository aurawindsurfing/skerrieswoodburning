<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->safeEmail,
        'accounts_payable' => $faker->randomElement([true,false]),
        'company_id' => factory('App\Company')->create()->id,
    ];
});
