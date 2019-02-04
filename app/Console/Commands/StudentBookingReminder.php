<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use Carbon\Carbon;

use App\NotificationLog;
use App\Notifications\StudentReminder;

class StudentBookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:booking_reminder_student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send booking reminders to students';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $student_bookings = Booking::query()
            ->where('reminder_sent', false)
            // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Trying to notify ' . $student_bookings->count() . ' students');

            foreach ($student_bookings as $booking) {
                $booking->notify(new StudentReminder($booking));
            }

        error_log('Send all student notifications');
    }
}