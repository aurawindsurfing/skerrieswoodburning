<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $booking = App\Booking::all()->random();
        $company = App\Company::all(['id'])->random();
        $user = App\User::all(['id'])->random();

        return [
            'prefix' => 'N-',
            'date' => $booking->date,
            'company_id' => $company,
            'total' => $booking->rate,
            'status' => $this->faker->randomElement(['paid', 'unpaid']),
            'user_id' => $user,
        ];
    }
}
