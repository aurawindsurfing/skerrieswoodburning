<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
     * @param Collection $bookings
     * @return void
     */
    public function create($bookings)
    {

        $invoice = Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => is_null($bookings->first()->company_id) ? null : $bookings->first()->company_id,
                'status' => 'unpaid',
                'user_id' => $this->user_id ?? auth()->user()->id,
            ]);


        foreach ($bookings as $booking) {

            $booking->update([
                'invoice_id' => $invoice->id
            ]);

            $invoice->update([
                'total' => $invoice->total + $booking->rate
            ]);
        
        }

        return $invoice;
        
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

    public function makePDF(Invoice $invoice)
    {
        $invoicePDF = \ConsoleTVs\Invoices\Classes\Invoice::make()
                    ->number($invoice->number());

        foreach ($invoice->bookings as $booking) {
            $invoicePDF->addItem(
                $booking->invoiceDescription(), 
                $booking->rate, 1,
                $booking->rate);
        }

        if ($invoice->company) {
            $invoicePDF->customer([
                'name' => $invoice->company->name ? : '',
                'tax' => $invoice->company->tax ? : '',
                'phone' => $invoice->company->phone ? : '',
                'location' => $invoice->company->address ? : '',
                'zip' => '',
                'city' => '',
                'country' => '',
            ]);
        } 

        $invoicePDF->save('public/tmp/invoices/' . $invoice->number() . '.pdf');
    }
}
