<?php

namespace App\Mail;

use App\Http\Controllers\InvoiceController;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewInvoice extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * $data
     *
     * @var Array
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alec@citltd.ie')
            ->subject('New invoice number: ' . $this->data['invoice_number'] . ' from CIT')
            ->attach(url($this->data['path']))
            ->view('emails.newinvoice');
    }
}
