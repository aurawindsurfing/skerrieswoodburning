<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use App\Notifications\BookingConfirmationSms;

class BookingConfirmations extends Command
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
        $bookings = Booking::where('confirmation_sent', null)->get();

        foreach ($bookings as $booking) {
            $booking->update(['confirmation_sent' => now()]);
            $booking->notify(new BookingConfirmationSms($booking));
        }
    }
}
