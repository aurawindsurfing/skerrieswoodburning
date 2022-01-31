<?php

namespace App\Console\Commands;

use App\Booking;
use App\Notifications\StudentConfirmation;
use App\Notifications\StudentCovidFormLink;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Propaganistas\LaravelPhone\PhoneNumber;

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
            ->whereHas('course', function ($q) {
                $q->where('date', '>=', Carbon::now()->toDateTimeString());
            })
            ->where('student_notified', false)
            ->whereCompanyId(null)
            ->whereNotNull('phone')
        // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Trying to notify '.$student_bookings->count().' students');

        foreach ($student_bookings as $booking) {
            if (PhoneNumber::make($booking->phone, config('nexmo.countries'))->isOfType('mobile')) {
                $booking->notify(new StudentCovidFormLink($booking));
                $booking->notify(new StudentConfirmation($booking));
            }
        }

        error_log('Send all student notifications');
    }
}
