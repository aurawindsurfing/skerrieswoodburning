<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\BookingConfirmationSms;
use App\Invoice;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function test()
    {
        dd(\Illuminate\Support\Facades\Storage::get('public/tmp/invoices/N-100.pdf'));
    }
}