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

        
        // $invoices = Invoice::where('id', '>', 102)->get();


        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadView('invoices.invoice', compact('invoices'));
        // $id = 'xxx';
        // return $pdf->stream('storage/tmp/invoices/N-'. $id .'.pdf');

        // return view('invoices.invoice', compact('invoices'));

        $c = Course::query()
        // ->addGlobalScope(UpcomingOnlyScope::class, new UpcomingOnlyScope);
        // ->withoutGlobalScope(UpcomingOnlyScope::class)
        // ->get();

        // dd($c);

        // $c
        ->withoutGlobalScope(UpcomingOnlyScope::class)
        ->get();

        dd($c);



    }


    public function test2()
    {
        $invoice = Invoice::find(106);
        
        return view('vendor.invoices.default', compact('invoice'));

    }
}