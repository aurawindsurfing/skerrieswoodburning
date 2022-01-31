<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class StudentCovidFormLink extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $message = (isset($notifiable->name) ? $notifiable->name.', thank you for booking. ' : 'Thank you for booking. ')
                    .'To finish your registration, please complete and submit this Covid-19 form today: https://form.jotform.com/201684563050350'
                    .'. CIT';

        $this->updateNotificationLog('sms covid form request', $notifiable, $message);

        return (new NexmoMessage)
                    ->content($message);
    }

    public function updateNotificationLog($type, $booking, $message)
    {
        $notification_log = NotificationLog::create([
            'booking_id' => $booking->id,
            'subject' => 'student',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);

        error_log('Notified student from booking id: '.$booking->id);
    }
}
