<?php

namespace Database\Seeders;

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
            'name' => 'Alec Hayden',
            'email' => 'alec@citltd.ie',
            'role' => 'admin',
            'password' => bcrypt('paycheck-sawmill-ascot-nicker-demented-rebuke-sweat-unlike'),
        ]);

        DB::table('users')->insert([
            'name' => 'Hank',
            'email' => 'hank@citltd.ie',
            'role' => 'admin',
            'password' => bcrypt('garlicky-auspice-eric-recount-hornpipe-shield-floe-brown'),
        ]);

        DB::table('users')->insert([
            'name' => 'Tomasz Lotocki',
            'email' => 'tomcentrumpl@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('KhvtJDdVp6s3xXtnNabUWzYrhIrzDToXrpUsWItZ'),
        ]);

        // \App\User::factory()->count(3)->create();
        // \App\Venue::factory()->count(50)->create();
        // \App\Tutor::factory()->count(20)->create();
        \App\CourseType::factory()->count(2)->create();

        // \App\Course::factory()->count(20)->create()->each(function ($course) {
        //     if ($course->multiday) {
        //         $course->course_dates()->saveMany(\App\CourseDate::factory()->count(rand(1,3))->make());
        //     }
        // });

        // \App\Contact::factory()->count(100)->create();
        // \App\Booking::factory()->count(100)->create();
        // \App\Invoice::factory()->count(100)->create();
        // \App\Payment::factory()->count(200)->create();
    }
}
