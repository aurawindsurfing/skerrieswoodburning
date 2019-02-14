<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\NotificationLog;

class StudentConfirmation extends Notification
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

        $message = (isset($notifiable->name) ? $notifiable->name . ', thank you for booking ' : 'Thank you for booking ')
                    . $notifiable->course->course_type->name . ' at: '
                    . $notifiable->course->venue->name . ' on: '
                    . $notifiable->course->date->format('Y-m-d') . ' '
                    . date('H:i', strtotime($notifiable->course->time)) . ' '
                    . (isset($notifiable->course->venue->google_maps) ? ' Directions: ' . $notifiable->course->venue->google_maps : '')
                    . '. CIT';

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