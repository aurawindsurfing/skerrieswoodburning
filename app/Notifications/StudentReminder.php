<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\NotificationLog;

class StudentReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        
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

        $message = (isset($notifiable->name) ? $notifiable->name . ', just a quick reminder, your course:  ' : 'Just a quick reminder, your course: ')
                    . $notifiable->course->course_type->name . ' takes place on '
                    . $notifiable->upcoming_course_dates()->first()->course->date->format('l') .' at: '
                    . $notifiable->upcoming_course_dates()->first()->course->venue->name . ' on: '
                    . date('H:i', strtotime($notifiable->upcoming_course_dates()->first()->course->time)) . ' '
                    . (isset($notifiable->upcoming_course_dates()->first()->course->venue->google_maps) ? ' Directions: ' . $notifiable->upcoming_course_dates()->first()->course->venue->google_maps : '')
                    . '. Please call us back if for any reasons you are unable to attend. CIT';

        $this->updateNotificationLog('sms course date reminder', $notifiable, $message);

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

        if ($booking->upcoming_course_dates()->count() == 1) {

            $booking->update(['reminders_sent' => true]);

        }

        error_log('Notified student from booking id: ' . $booking->id);
    }
}
