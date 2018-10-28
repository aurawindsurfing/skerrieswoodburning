<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Tomasz Lotocki',
            'email' => 'tomcentrumpl@gmail.com',
            'password' => bcrypt('alamakota'),
        ]);

        DB::table('users')->insert([
            'name' => 'Alec Hayden',
            'email' => 'alec@citltd.ie',
            'password' => bcrypt('cabbage'),
        ]);

        factory(App\User::class, 3)->create();

        factory(App\Venue::class, 50)->create();

        factory(App\Tutor::class, 20)->create();

        factory(App\Client::class, 100)->create();

        factory(App\PaymentMethod::class, 3)->create();

        factory(App\CourseType::class, 7)->create();

        factory(App\Course::class, 100)->create();

        // factory(App\Company::class, 100)->create();

        factory(App\Contact::class, 100)->create();

        factory(App\Booking::class, 100)->create();

    }
}
