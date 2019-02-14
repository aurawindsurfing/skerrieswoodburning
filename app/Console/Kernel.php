<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\CompanyBookingConfirmation::class,
        \App\Console\Commands\CompanyBookingReminder::class,
        \App\Console\Commands\StudentBookingConfirmation::class,
        \App\Console\Commands\StudentBookingReminder::class,
        \App\Console\Commands\EmailAttendeeList::class,
        \App\Console\Commands\CheckForMissingPPS::class,
        \App\Console\Commands\Import::class,
        \App\Console\Commands\InvoicePaymentReminder::class,
        \App\Console\Commands\ClearTemporaryFiles::class,
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
        $schedule->command('notify:booking_reminder_student')->timezone('Europe/Dublin')->dailyAt('14:00');

        $schedule->command('notify:newbookings_company')->timezone('Europe/Dublin')->everyFiveMinutes();
        $schedule->command('notify:booking_reminder_company')->timezone('Europe/Dublin')->weekdays()->at('9:30');

        $schedule->command('notify:attendeelist')->timezone('Europe/Dublin')->twiceDaily(6, 14);
        $schedule->command('notify:unpaid_invoices')->timezone('Europe/Dublin')->weekly()->mondays()->at('10:00');
        $schedule->command('housekeeping:clear_tmp_files')->timezone('Europe/Dublin')->daily();
        
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
