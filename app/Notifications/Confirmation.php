<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class Confirmation extends Notification
{
    use Queueable;

    /**s
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
        return (new NexmoMessage)
                    ->content(
                        (isset($notifiable->name) ? $notifiable->name . ', thank you for booking ' : 'Thank you for booking ')
                        . $notifiable->course->course_type->name . ' at: '
                        . $notifiable->course->venue->name . ' on: '
                        . $notifiable->course->date->format('Y-m-d H:m')
                        . ' we will text you exact directions one day before the course date. CIT'
                    );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->from('alec@citltd.ie')
            ->view(
                'emails.confirmation', compact('notifiable')
            );
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
}
