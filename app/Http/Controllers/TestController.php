<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use App\Payment;
use Vonage\SMS\Message\SMS;

class TestController extends Controller
{
    public function test()
    {

        $basic_auth = new \Vonage\Client\Credentials\Basic(env('NEXMO_KEY'), env('NEXMO_SECRET'));
        $client = new \Vonage\Client($basic_auth);

        $response = $client->sms()->send(
            new SMS('353862194744', 'CIT', 'Testujemy czy wysyla nam nexmo smsy')
        );

        $message = $response->current();

        if ($message->getStatus() == 0)
        {
            ray("The message was sent successfully");

        } else
        {
            ray("The message failed with status: " . $message->getStatus());
        }

    }

    public function pdftest1()
    {
        $credit_notes = \App\CreditNote::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.credit_note', compact('credit_notes'));
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('invoices.credit_note', compact('credit_notes'));
    }

    public function pdftest2()
    {
        $invoices = Invoice::skip(100)->take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('invoices'));
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('invoices.invoice', compact('invoices'));
    }

    public function pdftest3()
    {
        $receipts = Payment::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.payment_receipt', compact('receipts'));
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('invoices.payment_receipt', compact('receipts'));
    }

    public function pdftest4()
    {
        $bookings = Booking::take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_confirmation_manual_handling', compact('bookings'));
        $pdf->setOptions([
            'defaultMediaType' => 'all',
            'isFontSubsettingEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('letters.course_confirmation_manual_handling', compact('bookings'));
    }

    public function pdftest5()
    {
        $bookings = Booking::orderByDesc('id')->take(2)->get();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('letters.course_booking_confirmation', compact('bookings'));
        $pdf->setOptions([
            'defaultMediaType' => 'all',
            'isFontSubsettingEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('letters.course_booking_confirmation', compact('bookings'));
    }
}
