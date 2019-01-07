<?php

namespace App\Console\Commands;

use App\Booking;
use App\Contact;
use App\NotificationLog;
use App\Notifications\CompanyContactConfirmation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CompanyBookingConfirmation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:newbookings_company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new bookings to company contact';

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
            ->whereNotNull('contact_id')
            ->where('company_contact_notified', false)
            ->where('updated_at', '<', Carbon::now()->subMinutes(5)->toDateTimeString())
            ->get();

        $company_bookings = $company_bookings->groupBy('contact_id');

        error_log('Trying to notify ' . $company_bookings->count() . ' company contacts');

        foreach ($company_bookings as $contact_id => $bookings) {

            $contact = Contact::find($contact_id);

            $contact->notify(new CompanyContactConfirmation($bookings));

            foreach ($bookings as $booking) {
                $notification_log = NotificationLog::create([
                    'booking_id' => $booking->id,
                    'type' => 'company_contact',
                    'confirmation_sent' => now(),
                ]);

                $booking->update(['company_contact_notified' => true]);
                error_log('Notified company contact from booking id: ' . $booking->id);
            }

        };

        error_log('Send all company notifications');
    }
}
