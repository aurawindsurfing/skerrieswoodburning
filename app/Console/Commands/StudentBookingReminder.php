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
            ->where('reminders_sent', false)
            ->whereCompanyId(null)
            // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        $tomorrow_student_bookings = $student_bookings->filter(function ($booking) {
            return Carbon::make($booking->upcoming_course_dates()->first()->date)->isTomorrow();
        });

        error_log('Trying to notify ' . $tomorrow_student_bookings->count() . ' students');

            foreach ($tomorrow_student_bookings as $booking) {
                $booking->notify(new StudentReminder($booking));
            }

        error_log('Send all student notifications');
    }
}