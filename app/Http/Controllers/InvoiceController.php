<?php

namespace App\Http\Controllers;

use App\Company;
use App\Invoice;
use App\Mail\NewInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
     * create.
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
     * makePDF.
     *
     * @param mixed $invoices
     * @return void
     */
    public function makePDF($invoices)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('invoices.invoice', compact('invoices'));
        $id = uniqid();
        $path = '/storage/tmp/invoices/'.$id.'.pdf';
        $pdf->save(public_path($path));

        return $path;
    }

    public function preparePDF($models)
    {
        $invoices = collect([]);

        foreach ($models as $booking) {
            $invoice = $booking->invoice;
            $invoices->push($invoice);
        }

        $invoices = $invoices->unique();
        $invoicePDF = new self();
        $path = $invoicePDF->makePDF($invoices);

        return $path;
    }

    /**
     * generateInvoices.
     *
     * @param mixed $models
     * @return void
     */
    public function generateInvoices($models, $markAsPaid)
    {
        $uninvoiced_bookings = collect([]);
        $count = 0;

        foreach ($models as $booking) {
            if (is_null($booking->invoice_id)) {
                $uninvoiced_bookings->push($booking);
            }
        }

        if ($uninvoiced_bookings->isNotEmpty()) {
            $bookings = $uninvoiced_bookings->groupBy('company_id');
            $bookings_without_company = $bookings->pull('');

            //corporate booking

            if (! is_null($bookings) && $bookings->isNotEmpty()) {
                foreach ($bookings as $company_bookings) {
                    $invoice = $this->createCompanyInvoice($company_bookings);

                    if ($markAsPaid) {
                        foreach ($company_bookings as $booking) {
                            $payment = \App\Payment::create([
                                'amount' => $booking->rate,
                                'invoice_id' => $booking->invoice_id,
                                'payment_method' => 'cash',
                                'status' => 'completed',
                            ]);
                        }
                    }

                    $count++;
                }
            }

            // individual bookings

            if (! is_null($bookings_without_company) && $bookings_without_company->isNotEmpty()) {
                foreach ($bookings_without_company as $booking) {
                    $invoice = $this->createNonCompanyInvoice($booking);

                    if ($markAsPaid) {
                        $payment = \App\Payment::create([
                            'amount' => $booking->rate,
                            'invoice_id' => $booking->invoice_id,
                            'payment_method' => 'cash',
                            'status' => 'completed',
                        ]);
                    }

                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * createCompanyInvoice.
     *
     * @param mixed $bookings
     * @return void
     */
    public function createCompanyInvoice($bookings)
    {
        isset($bookings->first()->company_id) ? ($company_id = $bookings->first()->company_id) : ($company_id = null);

        $invoice = Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => $company_id,
                'payment_terms' => $company_id ? (Company::find($company_id)->payment_terms) : 0,
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
     * createNonCompanyInvoice.
     *
     * @param mixed $booking
     * @return void
     */
    public function createNonCompanyInvoice($booking)
    {
        $invoice = Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => null,
                'payment_terms' => 0,
                'status' => 'unpaid',
                'user_id' => $this->user_id ?? auth()->user()->id,
            ]);

        $invoice->fresh();

        $booking->update(['invoice_id' => $invoice->id]);
        $invoice->update(['total' => $invoice->total + $booking->rate]);

        return $invoice;
    }

    /**
     * emailInvoices.
     *
     * @param mixed $models
     * @return void
     */
    public function emailInvoices($models)
    {
        $invoices = collect([]);

        foreach ($models as $booking) {
            $invoice = $booking->invoice;
            $invoices = $invoices->push($invoice);
        }

        $invoices = $invoices->unique();
        $i = 0;

        foreach ($invoices as $invoice) {
            $inv = collect([$invoice]);

            $path = $this->makePDF($inv);

            $data = [
                'invoice_number' => $invoice->number(),
                'user_name' => $invoice->user->name,
                'path' => $path,
            ];

            foreach ($invoice->bookings as $booking) {
                if (isset($booking->email)) {
                    Mail::to($booking->email)
                        // ->cc('alec@citltd.ie')
                        ->queue(new NewInvoice($data));
                }

                if (isset($booking->accounts_payable)) {
                    if (isset($booking->company->accounts_payable->first()->email)) {
                        Mail::to($booking->company->accounts_payable->first()->email)
                            // ->cc('alec@citltd.ie')
                            ->queue(new NewInvoice($data));
                    }
                }
            }

            $i++;
        }

        return $i;
    }
}
