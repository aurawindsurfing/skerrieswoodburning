<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class WebsiteEnquiryCIT extends Notification
{
    use Queueable;

    private $form_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($form_data)
    {
        $this->form_data = $form_data;
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

        $text = $this->form_data->name
            .(isset($this->form_data->company) ? ' from '.$this->form_data->company.' ' : '')
            .(isset($this->form_data->type) ? ' made enquiry about '.$this->form_data->type.' course.' : ' did not ask for specific course type.')
            .' Phone: '.$this->form_data->phone
            .', email: '.$this->form_data->email
            .(isset($this->form_data->enquiry) ? ', message: '.$this->form_data->enquiry.' ' : '');

        return (new NexmoMessage)
            ->from($this->form_data->phone)
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
        $form_data = $this->form_data;
        return (new MailMessage)
            ->from($this->form_data->email)
            ->subject('New website enquiry from '.(isset($this->form_data->name) ? $this->form_data->name : ' --missing name-- '))
            ->view('emails.websiteEnquiryCIT', compact('form_data'));
    }
}
