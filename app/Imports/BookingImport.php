<?php

namespace App\Imports;

use App\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Tutor;
use App\Venue;
use App\Course;
use App\Company;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        {

            if (!str_contains($row['Date'], ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']))
            {
                $tutor = Tutor::updateOrCreate(
                    ['name' => $row['Date']], // this is yellow tutors name
                    ['name' => $row['Date']]
                );

                $venue = Venue::updateOrCreate(
                    ['name' => $row['Forename']], // this is yellow venue name
                    ['name' => $row['Forename']]
                );

                $course = Course::updateOrCreate(
                    ['date' => Carbon::parse($row['Company'])->format('Y-m-d'), 'venue' => $venue->id, 'tutor' => $tutor->id], // this is yellow venue name
                    [
                        'date'  => Carbon::parse($row['Company'])->format('Y-m-d'), 
                        'venue' => $venue->id, 
                        'tutor' => $tutor->id,
                        'time'  => '00:00:00',
                        'price' => 0,
                        'notes' => $row['Surname'], // this is yellow row SP number
                        'course_type_id' => 7
                    ]
                );
                
            } else {

                // company

                $company = Venue::updateOrCreate(
                    ['name' => $row['Forename']], // this is yellow venue name
                    ['name' => $row['Forename']]
                );

                // contact person



                Booking::create([
                    'date'       => $course->date, 
                    'name'       => $row['Forename'],
                    'surname'    => $row['Surname'],
                    ///////
                    'company'    => $row['Company'],
                    'email'      => $row['email'],
                    'at'         => $row['at_field'],
                ]);

                

            }

        }
    }
}
