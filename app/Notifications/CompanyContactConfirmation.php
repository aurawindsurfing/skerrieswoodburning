<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class CompanyContactConfirmation extends Notification
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
        $this->booking = $data['booking'];
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
                (isset($notifiable->contact) ? $notifiable->contact->name : '') 
                . ', this text is to confirm that we booked '
                . (!isset($notifiable->name) ?: $notifiable->name)  .' '. (!isset($notifiable->surname) ?: $notifiable->surname) . ' for: '
                . $notifiable->course->course_type->name . ' course at: '
                . $notifiable->course->venue->name . ' on: '
                . $notifiable->course->date->format('Y-m-d H:m')
                . '. Thank you. CIT'
            );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Company Booking Confirmation')
            ->from('alec@citltd.ie')
            ->view(
                'emails.companyconfirmation', ['booking' => $notifiable]
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
