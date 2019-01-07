<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\BookingConfirmation;
use App\Console\Commands\EmailAttendeeList;
use App\Console\Commands\CheckForMissingPPS;
use App\Console\Commands\Import;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CompanyBookingConfirmation::class,
        StudentBookingConfirmation::class,
        EmailAttendeeList::class,
        CheckForMissingPPS::class,
        Import::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:newbookings_student')->timezone('Europe/Dublin')->everyMinute();
        $schedule->command('notify:newbookings_company')->timezone('Europe/Dublin')->everyFiveMinutes();
        $schedule->command('notify:attendeelist')->timezone('Europe/Dublin')->twiceDaily(6, 14);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
