<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class MissingPPSConfirmation extends Notification
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
        return ['nexmo', 'mail'];
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
                        (isset($notifiable->name) ? $notifiable->name . ', we' : 'We' ) . ' are missing your PPS number. It is required to take part in  ' . 
                        $notifiable->course->course_type->name . ' course. ' .
                        ' Please call CIT at 018097266 and provide it asap.'
                    );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('We are missing your PPS number')
            ->from('alec@citltd.ie')
            ->view(
                'emails.missingPPS', compact('notifiable')
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
