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
            'role' => 'admin',
            'password' => bcrypt('alamakota'),
        ]);

        DB::table('users')->insert([
            'name' => 'Alec Hayden',
            'email' => 'alec@citltd.ie',
            'role' => 'admin',
            'password' => bcrypt('cabbage'),
        ]);

        DB::table('users')->insert([
            'name' => 'Hank',
            'email' => 'hank@citltd.ie',
            'role' => 'user',
            'password' => bcrypt('cabbage'),
        ]);

        factory(App\User::class, 3)->create();
        factory(App\Venue::class, 50)->create();
        factory(App\Tutor::class, 20)->create();
        factory(App\CourseType::class, 2)->create();
        factory(App\Course::class, 20)->create();
        factory(App\Contact::class, 100)->create();
        factory(App\Booking::class, 100)->create();
        factory(App\Invoice::class, 100)->create();
        factory(App\Payment::class, 200)->create();

    }
}
