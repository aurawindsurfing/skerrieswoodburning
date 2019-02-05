<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\View\View;
use App\NotificationLog;

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
        $this->bookings = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        $message = (isset($notifiable->contact) ? $notifiable->contact->name : '') 
                    . ', this text is to confirm that we booked '
                    . (!isset($notifiable->name) ?: $notifiable->name)  .' '. (!isset($notifiable->surname) ?: $notifiable->surname) . ' for: '
                    . $notifiable->course->course_type->name . ' course at: '
                    . $notifiable->course->venue->name . ' on: '
                    . $notifiable->course->date->format('Y-m-d H:m')
                    . '. Thank you. CIT';

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('sms booking confirmation', $booking, $message);
        }

        return (new NexmoMessage)
            ->content($message);
    }

    public function toMail($notifiable)
    {
        $message = view('emails.company_confirmation', ['bookings' => $this->bookings])->render();

        foreach ($this->bookings as $booking) {
            $this->updateNotificationLog('email booking confirmation', $booking, $message);
        }

        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->from('alec@citltd.ie')
            ->view('emails.company_confirmation', ['bookings' => $this->bookings]);
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

    public function updateNotificationLog($type, $booking, $message)
    {
        $notification_log = NotificationLog::create([
            'booking_id' => $booking->id,
            'subject' => 'company contact',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);

        $booking->update(['company_contact_notified' => true]);
        error_log('Notified company contact from booking id: ' . $booking->id);
    }
}
