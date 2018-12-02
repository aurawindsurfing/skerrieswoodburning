<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Illuminate\Support\Facades\Storage;
use App\Course;
use Illuminate\Support\Facades\Mail;
use App\Invoice;
use App\Scopes\UpcomingOnlyScope;



class TestController extends Controller
{

    public function test()
    {

        
        $e = '0862194744';

        echo('353' . ltrim($e, '0'));



    }

    public function pdftest1()
    {
        $bookings = Booking::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        // return view('letters.course_confirmation_manual_handling', compact('bookings'));

    }

    public function pdftest2()
    {
        $bookings = Booking::take(2)->get();

        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        // $id = 'xxx';
        // return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        return view('letters.course_confirmation_manual_handling', compact('bookings'));

    }


    public function test2()
    {
        $invoice = Invoice::find(106);
        
        return view('vendor.invoices.default', compact('invoice'));

    }
}