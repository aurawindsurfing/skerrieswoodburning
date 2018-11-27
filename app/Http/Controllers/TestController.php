<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Illuminate\Support\Facades\Storage;
use App\Course;
use Illuminate\Support\Facades\Mail;
use App\Invoice;



class TestController extends Controller
{

    public function test()
    {

        
        $invoices = Invoice::where('id', '>', 99)->get();


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('invoices'));
        $id = 'xxx';
        return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        // return view('invoices.invoice', compact('invoices'));

    }


    public function test2()
    {
        $invoice = Invoice::find(106);
        
        return view('vendor.invoices.default', compact('invoice'));

    }
}