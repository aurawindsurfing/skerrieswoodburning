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
        
        $c = \App\Course::whereDate('date',Carbon::now()->addDay()->toDateString())->get();

        dd($c);

        }
    }
