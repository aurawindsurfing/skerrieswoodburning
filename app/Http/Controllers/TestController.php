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

        $data = [];
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation', $data);
        return $pdf->stream();

        // return view('letters.course_confirmation');

    }
}