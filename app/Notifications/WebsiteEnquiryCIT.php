<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class WebsiteEnquiryCIT extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return isset($notifiable->phone) ? ['nexmo', 'mail'] : ['mail'];
    }

    public function toNexmo($notifiable)
    {
        $text = $this->data['name']
            .(isset($this->data['company']) ? ' from '.$this->data['company'].' ' : '')
            .(isset($this->data['type']) ? ' made enquiry about '.$this->data['type'].' course.' : ' did not ask for specific course type.')
            .' Phone: '.$this->data['phone']
            .', email: '.$this->data['email']
            .(isset($this->data['enquiry']) ? ', message: '.$this->data['enquiry'].' ' : '');

        return (new NexmoMessage)
            ->from('+'.$this->data['phone'])
            ->content($text);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = $this->data;

        return (new MailMessage)
            ->from($this->data['email'])
            ->subject('New website enquiry from '.($this->data['name'] ?? ' --missing name-- '))
            ->view('emails.websiteEnquiryCIT', compact('data'));
    }
}
