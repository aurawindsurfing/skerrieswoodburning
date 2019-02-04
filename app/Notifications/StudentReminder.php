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

    protected $dates;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->dates = $data;
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
                    . $notifiable->course->course_type->name . ' at: '
                    . $notifiable->course->venue->name . ' on: '
                    . $notifiable->course->date->format('Y-m-d H:m')
                    . ' we will text you exact directions one day before the course date. CIT';

        $this->updateNotificationLog('sms booking confirmation', $notifiable, $message);

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

        $booking->update(['student_notified' => true]);
        error_log('Notified student from booking id: ' . $booking->id);
    }
}
