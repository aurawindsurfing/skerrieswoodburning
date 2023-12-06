<?php

namespace Database\Factories;

use App\Scopes\UpcomingOnlyScope;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course = \App\Course::query()->withoutGlobalScope(UpcomingOnlyScope::class)->get()->random();
        $bookingDate = $this->faker->dateTimeBetween($startDate = $course->date.' -4 weeks', $endDate = $course->date.' -1 days', $timezone = 'Europe/Dublin');
        $company = App\Company::all(['id'])->random();

        $fake_or_false_company = $this->faker->randomElement([$company, null]);

        return [
            'date' => $bookingDate,
            'course_id' => $course->id,
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->randomElement(['0862194744', '0868065966']),
            'email' => $this->faker->randomElement(['tomcentrumpl@gmail.com', 'alec@citltd.ie', 'hank@citltd.ie']),
            'pps' => $this->faker->boolean,
            'rate' => $this->faker->randomElement([85, 95, 100, 115]),
            'payment_type' => $this->faker->randomElement(['cash', 'invoice', 'cheque']),
            'company_id' => $fake_or_false_company,
            'contact_id' => $fake_or_false_company ? $fake_or_false_company->contacts->first() : null,
            'po' => $this->faker->optional()->randomNumber,
            'student_notified' => true,
            'company_contact_notified' => true,
            'reminders_sent' => true,
            'company_contact_reminders_sent' => true,
            'pps_reminder_sent' => true,
            'confirmed' => $this->faker->boolean,
            'no_show' => $this->faker->boolean,
            'user_id' => $this->faker->optional()->randomElement(App\User::all(['id'])),
            'comments' => $this->faker->optional()->text,
            'created_at' => $bookingDate,
            'updated_at' => $bookingDate,
        ];
    }
}
