<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\View\View;

class CompanyContactReminder extends Notification
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
        $message = view('emails.company_booking_reminder', ['bookings' => $this->bookings])->render();

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('company contact remided about booking', $booking, $message);
        }

        return (new MailMessage)
            ->subject('Booking Reminder')
            ->from('alec@citltd.ie')
            ->view('emails.company_booking_reminder', ['bookings' => $this->bookings]);
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

        if ($booking->upcoming_course_dates()->count() == 1) {
            $booking->update(['company_contact_reminders_sent' => true]);
        }

        error_log('Notified company contact from booking id: '.$booking->id);
    }
}
