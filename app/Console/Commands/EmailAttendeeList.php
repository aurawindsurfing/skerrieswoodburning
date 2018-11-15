<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class EmailAttendeeList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:attendeelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emails tomorrow courses list to CIT';

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
        $courses = \App\Course::query()
                        ->whereDate('date', Carbon::now()->addDay()->toDateString())
                        ->get();

        if (isset($courses)) {
            foreach ($courses as $course ) {
                Excel::store(new \App\Exports\AttendeeExport($course), 'attendees.xlsx');
            }
        }
    }
}