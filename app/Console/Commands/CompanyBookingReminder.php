<?php

namespace App\Console\Commands;

use App\Booking;
use App\Contact;
use App\NotificationLog;
use App\Notifications\CompanyContactReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CompanyBookingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:booking_reminder_company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bookings reminder to company contact';

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
        $company_bookings = Booking::query()
            ->whereHas('course', function ($q) {
                $q->where('date', '>=', Carbon::now()->toDateTimeString());
            })
            ->whereNotNull('contact_id')
            ->where('company_contact_reminders_sent', false)
            ->get();

        $next_company_bookings = $company_bookings->filter(function ($booking) {
            if (Carbon::today()->isFriday()) {
                $saturday = Carbon::tomorrow();
                $monday = Carbon::make('next monday');

                return Carbon::make($booking->upcoming_course_dates()->first()->date)->between($saturday, $monday);
            } else {
                return Carbon::make($booking->upcoming_course_dates()->first()->date)->isTomorrow();
            }
        });

        $next_company_bookings = $next_company_bookings->groupBy('contact_id');

        error_log('Trying to notify '.$next_company_bookings->count().' company contacts');

        foreach ($next_company_bookings as $contact_id => $bookings) {
            $contact = Contact::find($contact_id);
            $contact->notify(new CompanyContactReminder($bookings));
        }

        error_log('Send all company booking reminders');
    }
}
