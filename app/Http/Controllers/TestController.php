<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use App\Payment;
use Propaganistas\LaravelPhone\PhoneNumber;
use Laravel\Nova\Fields\Place;
use Carbon\Carbon;

class TestController extends Controller
{

    public function test()
    {

        $student_bookings = Booking::query()
            ->whereHas('course', function($q){
                $q->where('date', '>=', Carbon::now()->toDateTimeString());
            })
            ->where('student_notified', false)
            ->whereCompanyId(null)
            ->whereNotNull('phone')
        // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

            dd($student_bookings);

    }

    public function pdftest1()
    {
        $credit_notes = \App\CreditNote::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.credit_note', compact('credit_notes'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-' . $id . '.pdf');

        return view('invoices.credit_note', compact('credit_notes'));

    }

    public function pdftest2()
    {
        $invoices = Invoice::skip(100)->take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('invoices'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-' . $id . '.pdf');

        return view('invoices.invoice', compact('invoices'));

    }

    public function pdftest3()
    {
        $receipts = Payment::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.payment_receipt', compact('receipts'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-' . $id . '.pdf');

        return view('invoices.payment_receipt', compact('receipts'));

    }

    public function pdftest4()
    {
        $bookings = Booking::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        $pdf->setOptions(['defaultMediaType' => 'all', 'isFontSubsettingEnabled' => true]);
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-' . $id . '.pdf');

        return view('letters.course_confirmation_manual_handling', compact('bookings'));

    }
}
