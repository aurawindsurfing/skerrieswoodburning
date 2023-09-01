<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Scopes\StripePaymentOk;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handlePaymentIntentSucceeded($payload)
    {
        $booking = Booking::withoutGlobalScope(StripePaymentOk::class)->where('stripe_payment_intent', $payload['data']['object']['id'])->first();

        // sometimes booking is not find as we can have manual transaction in stripe and payment intent does not match any bookings
        if (isset($booking)){
            $booking->stripe_status = 'succeeded';
            $booking->save();
        }

    }
}
