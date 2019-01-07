<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use Carbon\Carbon;
use App\Notifications\Confirmation;
use App\Notifications\MissingPPSConfirmation;
use App\Notifications\CompanyContactConfirmation;
use App\NotificationLog;

class StudentBookingConfirmation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:newbookings_student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send confirmations to new bookings';

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
            ->where('student_notified', false)
            // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Trying to notify ' . $student_bookings->count() . ' students');

            foreach ($student_bookings as $booking) {
                $booking->notify(new Confirmation($booking));

                $notification_log = NotificationLog::create([
                    'booking_id' => $booking->id,
                    'type' => 'student',
                    'confirmation_sent' => now()
                ]);

                $booking->update(['student_notified' => true]);
                error_log('Notified student from booking id: ' . $booking->id);

            }

        error_log('Send all student notifications');
    }
}