<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\BookingConfirmationSms;
use App\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    public function test()
    {
        dd(url(Storage::url('tmp/invoices/N-100.pdf')));
    }
}