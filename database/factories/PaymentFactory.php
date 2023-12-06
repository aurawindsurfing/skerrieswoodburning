<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $invoice = App\Invoice::all(['id'])->random();
        // $booking = App\Booking::all(['id'])->random();

        return [
            'amount' => $this->faker->randomElement([10, 30, 45, 35, 55, 65, 70]),
            'payment_method' => $this->faker->randomElement(['cc', 'eft', 'cash', 'cheque']),
            'status' => $this->faker->randomElement(['completed', 'cancelled']),
            'invoice_id' => $invoice->id,
            // 'booking_id' => $booking
        ];
    }
}
