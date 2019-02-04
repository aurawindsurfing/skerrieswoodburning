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
use App\Contact;
use Nexmo;
use App\Payment;

class TestController extends Controller
{

    public function test()
    {

        HasMany::make('Gym')

            ->canSee(function () {

                return $this->member;

            }),

    }

    public function pdftest1()
    {
        $credit_notes = \App\CreditNote::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.credit_note', compact('credit_notes'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        return view('invoices.credit_note', compact('credit_notes'));

    }

    public function pdftest2()
    {
        $invoices = Invoice::skip(100)->take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('invoices'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        return view('invoices.invoice', compact('invoices'));

    }

    public function pdftest3()
    {
        $receipts = Payment::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.payment_receipt', compact('receipts'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        return view('invoices.payment_receipt', compact('receipts'));

    }

    public function pdftest4()
    {
        $bookings = Booking::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        $pdf->setOptions(['defaultMediaType' => 'all', 'isFontSubsettingEnabled' => true ]);
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        return view('letters.course_confirmation_manual_handling', compact('bookings'));

    }
}
