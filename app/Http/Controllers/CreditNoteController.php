<?php

namespace App\Http\Controllers;

use App\CreditNote;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\CreditNote  $creditNote
     * @return \Illuminate\Http\Response
     */
    public function show(CreditNote $creditNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreditNote  $creditNote
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditNote $creditNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreditNote  $creditNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditNote $creditNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreditNote  $creditNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditNote $creditNote)
    {
        //
    }

     /**
     * makePDF
     *
     * @param mixed $invoices
     * @return void
     */
    public function makePDF($credit_notes)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.credit_note', compact('credit_notes'));
        $id = uniqid();
        $path = '/storage/tmp/invoices/'. $id .'.pdf';
        $pdf->save(public_path($path));

        return $path;

    }

    // public function preparePDF($models)
    // {
    //     $invoices = collect([]);

    //     foreach ($models as $booking ) {
    //         $invoice = $booking->invoice;
    //         $invoices->push($invoice);
    //     }

    //     $invoices = $invoices->unique();
    //     $invoicePDF = new \App\Http\Controllers\InvoiceController();
    //     $path = $invoicePDF->makePDF($invoices);

    //     return $path;
    // }
}
