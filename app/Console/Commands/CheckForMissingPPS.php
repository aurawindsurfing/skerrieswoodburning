<?php

namespace App\Console\Commands;

use App\Booking;
use App\Notifications\MissingPPSCIT;
use App\Notifications\MissingPPSConfirmation;
use App\User;
use Illuminate\Console\Command;
use Propaganistas\LaravelPhone\PhoneNumber;

class CheckForMissingPPS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:missing_pps';

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
            ->where('pps_reminder_sent', false)
            //->where('updated_at', '<', Carbon::now()->subMinutes(2)->toDateTimeString())
            ->get();

        error_log('Sending '.$bookings->count().' pps reminders');

        foreach ($bookings as $booking) {
            if ($booking->pps == false) {
                if (PhoneNumber::make($booking->phone, config('nexmo.countries'))->isOfType('mobile')) {
                    $booking->notify(new MissingPPSConfirmation($booking));
                    $u = User::find(1);
                    $u->notify(new MissingPPSCIT($booking));
                    $booking->update(['pps_reminder_sent' => true]);
                }
            }
        }
    }
}
