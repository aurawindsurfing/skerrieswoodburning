<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\BookingConfirmationSms;


class TestController extends Controller
{
    public function test()
    {
        // $bookings = Booking::query()
        //     ->where('confirmation_sent', null)
        //     ->where('updated_at', '<', Carbon::now()->subSeconds(120)->toDateTimeString())
        //     ->get();

        // foreach ($bookings as $booking) {
        //     $booking->update(['confirmation_sent' => now()]);
        //     $booking->notify(new BookingConfirmationSms());
        // }


        $invoice = \App\Invoice::find(1);

        return new \App\Mail\NewInvoice($invoice);



    }
}
