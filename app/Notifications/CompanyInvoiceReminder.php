<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\NotificationLog;

class CompanyInvoiceReminder extends Notification
{
    use Queueable;

    protected $invoices;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = view('emails.company_invoice_reminder', ['invoices' => $this->invoices])->render();

        foreach ($this->invoices as $unpaid_invoice) {
            $this->updateNotificationLog('company unpaid invoices 7 days reminder', $unpaid_invoice, $message);
        }

        error_log('Notified company about ' . $this->invoices->count() . ' unpaid invoices');

        //
        //
        //
        //
        
        // $path = $this->makePDF($inv);


        return (new MailMessage)
            ->subject('Invoice Payment Reminder')
            ->from('alec@citltd.ie')
            // ->attach(url($this->data['path']))
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
