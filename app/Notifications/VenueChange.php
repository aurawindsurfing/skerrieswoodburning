<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class VenueChange extends Notification implements ShouldQueue
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
        $message = strtoupper($notifiable->course->course_type->name)
                    .' VENUE HAS CHANGED!!! '
                    .(isset($notifiable->name) ? $notifiable->name.', your ' : 'Your ')
                    .$notifiable->course->course_type->name.' course on: '
                    .$notifiable->course->date->format('Y-m-d').' '
                    .date('H:i', strtotime($notifiable->course->time)).' '
                    .' venue has been changed to: '
                    .$notifiable->course->venue->name
                    .(isset($notifiable->course->venue->google_maps) ? ', here are exact directions: '.$notifiable->course->venue->google_maps : '')
                    .' We are sorry for any inconvenience caused. CIT';

        $this->updateNotificationLog('sms venue change', $notifiable, $message);

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
