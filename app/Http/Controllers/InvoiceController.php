<?php

namespace App\Http\Controllers;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * create
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {

        //
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    /**
     * makePDF
     *
     * @param Invoice $invoice
     * @return void
     */
    public function makePDF(Invoice $invoice)
    {
        $invoicePDF = \ConsoleTVs\Invoices\Classes\Invoice::make()->number($invoice->number());

        foreach ($invoice->bookings as $booking) {
            $invoicePDF->addItem(
                $booking->invoiceDescription(), 
                $booking->rate, 1,
                $booking->rate);
        }

        $invoicePDF->customer([
            'name' => isset($invoice->company->name) ? $invoice->company->name : $invoice->bookings->first()->name .' '. $invoice->bookings->first()->surname,
            'tax' => isset($invoice->company->tax) ? $invoice->company->tax : $invoice->bookings->first()->pps,
            'phone' => isset($invoice->company->phone) ? $invoice->company->phone : $invoice->bookings->first()->phone,
            'location' => isset($invoice->company->address) ? $invoice->company->address : '',
            'zip' => '',
            'city' => '',
            'country' => '',
        ]);

        $invoicePDF->save('public/tmp/invoices/' . $invoice->number() . '.pdf');
    }

    /**
     * createMultipleBookingsInvoice
     *
     * @param mixed $bookings
     * @return void
     */
    public function createMultipleBookingsInvoice($bookings)
    {
        
        $invoice = Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => isset($bookings->first()->company_id) ?: null,
                'status' => 'unpaid',
                'user_id' => $this->user_id ?? auth()->user()->id,
            ]);

        $invoice->fresh();

        foreach ($bookings as $booking) {
            $booking->update(['invoice_id' => $invoice->id]);
            $invoice->update(['total' => $invoice->total + $booking->rate]);
        }
    
        return $invoice;
        
    }


    /**
     * createSingleBookingInvoice
     *
     * @param mixed $booking
     * @return void
     */
    public function createSingleBookingInvoice($booking)
    {

        $invoice = Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => null,
                'status' => 'unpaid',
                'user_id' => $this->user_id ?? auth()->user()->id,
            ]);

        $invoice->fresh();

        $booking->update(['invoice_id' => $invoice->id]);
        $invoice->update(['total' => $invoice->total + $booking->rate]);
    
        return $invoice;
        
    }

}
