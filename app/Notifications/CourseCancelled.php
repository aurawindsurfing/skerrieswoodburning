<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\NotificationLog;

class CourseCancelled extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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

        $message =  strtoupper($notifiable->course->course_type->name)
                    . ' HAS BEEN CANCELLED!!! '
                    . (isset($notifiable->name) ? $notifiable->name . ', your ' : 'Your ')
                    . $notifiable->course->course_type->name . ' course on: '
                    . $notifiable->course->date->format('Y-m-d') 
                    . date('H:i', strtotime($notifiable->course->time)) . ' '
                    . ' at: '
                    . $notifiable->course->venue->name
                    . ' has been CANCELLED!!! '
                    . ' We are sorry for any inconvenience caused. CIT';

        $this->updateNotificationLog('sms course cancellation info', $notifiable, $message);

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

        error_log('Notified student from booking id: ' . $booking->id);
    }
}
