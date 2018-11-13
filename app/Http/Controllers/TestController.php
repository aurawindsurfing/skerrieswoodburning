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
        
        // $invoice = Invoice::find(106);

        // $inv = new InvoiceController();
        // $inv->makePDF($invoice);

        // Mail::to('tomcentrumpl@gmail.com')
        //     ->cc('tom@gazeta.ie')
        //     ->cc('alec@citltd.ie')
        //     ->send(new \App\Mail\NewInvoice($invoice));

        $b = Booking::find(4);

        // dd($b);

        $inv = new InvoiceController();
        // $inv->createMissingCompany($b);
        
        // dd($b);

        $inv->createSingleBookingInvoice($b);

        // dd($inv);



        
    }
}
