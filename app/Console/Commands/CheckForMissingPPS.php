<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use Carbon\Carbon;
use App\Notifications\Confirmation;
use App\Notifications\MissingPPSConfirmation;

class CheckForMissingPPS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:missingpps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send PPS requests to bookings without PPS';

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
            ->where('pps', false)
            ->where('pps_reminder_sent', null)
            ->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Sending ' . $bookings->count() . ' pps reminders');

        foreach ($bookings as $booking) {
            $booking->update(['pps_reminder_sent' => now()]);
            !isset($booking->pps) ?: $booking->notify(new MissingPPSConfirmation);
        }
    }
}
