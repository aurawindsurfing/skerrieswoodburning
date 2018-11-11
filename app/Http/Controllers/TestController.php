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
        // $user->where('email', 'tom@gazeta.ie')->get();

        // $bookings = Booking::whereConfirmationSent(true)->get();
        $bookings = Booking::where('confirmation_sent', null)->get();

        // $booking->notify(new BookingConfirmationSms($booking));

        // $bookings = Booking::where('confirmation_sent', false)->get();

        dd($bookings);

    }
}
