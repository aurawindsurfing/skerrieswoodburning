<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\NotificationLog;

class CompanyInvoicePaymentReminder extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * $data
     *
     * @var Array
     */
    public $path;

    public $invoices;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->path = $data['path'];
        $this->invoices = $data['invoices'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = view('emails.company_invoice_reminder', ['invoices' => $this->invoices])->render();

        foreach ($this->invoices as $unpaid_invoice) {
            $this->updateNotificationLog('company unpaid invoices 7 days reminder', $unpaid_invoice, $message);
        }

        error_log('Notified company about ' . $this->invoices->count() . ' unpaid invoices');

        return $this->from('alec@citltd.ie')
            ->subject('Invoice Payment Reminder')
            ->attach(url($this->path))
            ->view('emails.company_invoice_reminder', ['invoices' => $this->invoices]);

    }


    public function updateNotificationLog($type, $unpaid_invoice, $message)
    {
        $notification_log = NotificationLog::create([
            'invoice_id' => $unpaid_invoice->id,
            'subject' => 'accounts payable',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);
    }
}
