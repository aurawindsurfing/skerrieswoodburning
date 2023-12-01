<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyVenueChange extends Notification implements ShouldQueue
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = view('emails.company_venue_change', ['bookings' => $this->bookings])->render();

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('email venue change', $booking, $message);
        }

        return (new MailMessage)
            ->subject('Course Venue Change Notification!!!')
            ->from(config('settings.admin_email'))
            ->view('emails.company_venue_change', ['bookings' => $this->bookings]);
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

        error_log('Notified company contact from booking id: '.$booking->id);
    }
}
