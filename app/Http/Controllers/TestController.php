<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use App\Company;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CompanyContactConfirmation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BookingImport;
use Carbon\Carbon;

class TestController extends Controller
{

    public function test()
    {
        $i = Booking::take(20)->paginate(5);

        dd($i);
    }

    public function pdftest1()
    {
        $bookings = Booking::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-' . $id . '.pdf');

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
