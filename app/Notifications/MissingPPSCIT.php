<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class MissingPPSCIT extends Notification
{
    use Queueable;

    private $booking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo', 'mail'];
    }

    public function toNexmo($notifiable)
    {
        $text = 'Missing PPS number for '.(isset($this->booking->name) ? $this->booking->name.' ' : ' --missing name-- ')
        .$this->booking->course->course_type->name.' at: '
        .$this->booking->course->venue->name.' on: '
        .$this->booking->course->date->format('Y-m-d').' '
        .date('H:i', strtotime($this->booking->course->time))
        .' Give him a call at: '.$this->booking->phone;

        return (new NexmoMessage)->content($text);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $booking = $this->booking;

        return (new MailMessage)
            ->subject('Missing PPS number for: '.(isset($this->booking->name) ? $this->booking->name : ' --missing name-- ').(isset($this->booking->surname) ? $this->booking->surname : ' --missing surname-- '))
            ->view('emails.missingPPSCIT', compact('booking'));
    }
}
