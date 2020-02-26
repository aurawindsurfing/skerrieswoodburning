<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
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
            foreach ($courses as $course) {
                $filepath = 'tmp/lists/'.str_replace(' ', '_', $course->course_type->name).'_'.$course->date->format('Y-m-d').'_'.str_replace(' ', '_', $course->venue->name).'_attendees.xlsx';

                $data = [
                    'course' => $course,
                    'filepath' => $filepath,
                ];

                Excel::store(new \App\Exports\AttendeeExport($course), 'public/'.$filepath);

                Mail::to('alec@citltd.ie')
                // ->cc('tom@gazeta.ie')
                    ->cc('tomcentrumpl@gmail.com')
                    ->send(new \App\Mail\CourseAttendeeList($data));
            }
        }
    }
}
