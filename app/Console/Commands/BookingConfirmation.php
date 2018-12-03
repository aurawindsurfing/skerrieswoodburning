<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use Carbon\Carbon;
use App\Notifications\Confirmation;
use App\Notifications\MissingPPSConfirmation;
use App\Notifications\CompanyContactConfirmation;

class BookingConfirmation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:newbookings';

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
        $bookings = Booking::query()
            ->where('confirmation_sent', null)
            // ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Trying to send ' . $bookings->count() . ' confirmations');

        foreach ($bookings as $booking) {
            $booking->notify(new Confirmation($booking));
            $booking->notify(new CompanyContactConfirmation($booking));

            $booking->update(['confirmation_sent' => now()]);
            error_log('Send booking id:' . $booking->id . ' confirmation');
        }

        error_log('Send all confirmations');
    }
}