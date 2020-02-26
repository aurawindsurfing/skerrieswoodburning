<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\View\View;

class CompanyContactConfirmation extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->bookings = $data;
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

    public function toMail($notifiable)
    {
        $message = view('emails.company_confirmation', ['bookings' => $this->bookings])->render();

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('email booking confirmation', $booking, $message);
        }

        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->from('alec@citltd.ie')
            ->view('emails.company_confirmation', ['bookings' => $this->bookings]);
    }

    public function updateNotificationLog($type, $booking, $message)
    {
        $notification_log = NotificationLog::create([
            'booking_id' => $booking->id,
            'subject' => 'company contact',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);

        $booking->update(['company_contact_notified' => true]);
        error_log('Notified company contact from booking id: '.$booking->id);
    }
}
