<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->randomElement(['0862194744', '0868065966']),
        'email' => $faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
        'accounts_payable' => $faker->randomElement([true, false]),
        'company_id' => factory('App\Company')->create()->id,
    ];
});
