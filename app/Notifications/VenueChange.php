<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\NotificationLog;

class VenueChange extends Notification
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
                    . ' VENUE HAS CHANGED!!! '
                    . (isset($notifiable->name) ? $notifiable->name . ', your ' : 'Your ')
                    . $notifiable->course->course_type->name . ' course on: '
                    . $notifiable->course->date->format('Y-m-d H:m')
                    . ' venue has been changed to: '
                    . $notifiable->course->venue->name
                    . (isset($notifiable->course->venue->google_maps) ? ', here are exact directions: ' . $notifiable->course->venue->google_maps : '')
                    . ' We are sorry for any inconvenience caused. CIT';

        $this->updateNotificationLog('sms venue change', $notifiable, $message);

        return (new NexmoMessage)
                    ->content($message);
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
            'subject' => 'student',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);

        $booking->update(['student_notified' => true]);
        error_log('Notified student from booking id: ' . $booking->id);
    }
}
