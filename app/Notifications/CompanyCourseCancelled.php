<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\NotificationLog;

class CompanyCourseCancelled extends Notification
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

        $message = view('emails.company_course_cancelled', ['bookings' => $this->bookings])->render();

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('email company course cancellation notice', $booking, $message);
        }

        return (new MailMessage)
            ->subject('Course Cancellation Notice!!!')
            ->from('alec@citltd.ie')
            ->view('emails.company_course_cancelled', ['bookings' => $this->bookings]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
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

        error_log('Notified company contact from booking id: ' . $booking->id);
    }
}
