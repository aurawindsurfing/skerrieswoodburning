<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Invoice;
use App\Payment;

class TestController extends Controller
{
    public function test()
    {
        \Cloudinary::config([
            "cloud_name" => env('CLOUDINARY_CLOUD_NAME'),
            "api_key"    => env('CLOUDINARY_API_KEY'),
            "api_secret" => env('CLOUDINARY_API_SECRET'),
            "secure"     => true,
        ]);

        $c = new \Cloudinary\Api();
        $response = $c->resources(
            [
                "type"        => "upload",
                "prefix"      => "cit/logos",
                "max_results" => 50,
            ]
        );

        $logos = [];

        foreach ($response['resources'] as $resource)
        {
            array_push($logos, $resource['secure_url']);
        }

        return $logos;
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
            'isRemoteEnabled' => true
        ]);
        $id = 'xxx';

        return $pdf->stream('storage/tmp/invoices/N-'.$id.'.pdf');

        return view('letters.course_confirmation_manual_handling', compact('bookings'));
    }

    public function pdftest5()
    {
        $bookings = Booking::take(2)->get();

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
