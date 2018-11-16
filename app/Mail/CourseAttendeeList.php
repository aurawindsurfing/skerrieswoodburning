<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\InvoiceController;

class CourseAttendeeList extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('alec@citltd.ie')
                    ->subject($this->data['course']->course_type->name . '_' . $this->data['course']->date->format('Y-m-d'). '_' . $this->data['course']->venue->name)
                    ->attach(config('app.url') . $this->data['filepath'])
                    ->view('emails.attendee_list');
    }
}
