<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\InvoiceController;


class NewInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $invoicePDF = new InvoiceController();
        $invoicePDF->makePDF($this->invoice);

        return $this->from('alec@citltd.ie')
                    ->subject('New invoice number: ' . $this->invoice->number() . ' from CIT')
                    ->attach(url(Storage::url('tmp/invoices/' . $this->invoice->number() . '.pdf')))
                    ->view('emails.newinvoice');

    }
}
