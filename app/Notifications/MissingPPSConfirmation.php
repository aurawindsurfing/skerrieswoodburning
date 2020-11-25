<?php

namespace App\Notifications;

use App\NotificationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Nexmo\Laravel\Facade\Nexmo;

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

        $alec_messege = 'Missing PPS number for '.$notifiable->name.' '.$notifiable->surname.
                        ' Give him a call at: '. $notifiable->phone;

        Nexmo::message()->send([
            'to'   => $notifiable->phone,
            'from' => '+353868065966',
            'text' => $alec_messege
        ]);


        $message = (isset($notifiable->name) ? $notifiable->name.', we' : 'We').' are missing your PPS number. It is required to take part in  '.
                    $notifiable->course->course_type->name.' course. '.
                    ' Please call CIT at 018097266 and provide it asap.';

        $this->updateNotificationLog('sms pps reminder', $notifiable, $message);

        return (new NexmoMessage)
                    ->content($message);
    }

    public function toMail($notifiable)
    {
        $message = view('emails.missingPPS', compact('notifiable'))->render();

        $this->updateNotificationLog('email pps reminder', $notifiable, $message);

        return (new MailMessage)
            ->subject('We are missing your PPS number')
            ->from('alec@citltd.ie')
            ->bcc('alec@citltd.ie')
            ->view('emails.missingPPS', compact('notifiable'));
    }

    public function updateNotificationLog($type, $booking, $message)
    {
        $notification_log = NotificationLog::create([
            'booking_id' => $booking->id,
            'subject' => 'company_contact',
            'type' => $type,
            'message' => $message,
            'confirmation_sent' => now(),
        ]);

        $booking->update(['company_contact_notified' => true]);
        error_log('Notified company contact from booking id: '.$booking->id);
    }
}
