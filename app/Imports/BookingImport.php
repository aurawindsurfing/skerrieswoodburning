<?php

namespace App\Imports;

use App\Booking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Carbon\Carbon;
use App\Tutor;
use App\Venue;
use App\Course;
use App\Company;
use App\Contact;

class BookingImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        $output = new ConsoleOutput();
        error_log('Importing bookings');
        $bar = new ProgressBar($output, count($rows));

        foreach ($rows as $row) 
        {

            $bar->advance();

            if (!str_contains($row['date'], ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']) && !empty($row['date']))
            {
                $tutor = Tutor::updateOrCreate(
                    ['name' => $row['date']], // this is yellow tutors name
                    ['phone' => null, 'email' => null]
                );

                $venue = Venue::updateOrCreate(
                    ['name' => $row['forename']], // this is yellow venue name
                    ['name' => $row['forename']]
                );

                $course = Course::updateOrCreate(
                    [
                        'date' => Carbon::parse($row['company'])->format('Y-m-d'), // this is yellow course date
                        'venue_id' => $venue->id, 
                        'tutor_id' => $tutor->id], 
                    [
                        'time'              => '00:00:00',
                        'price'             => 0,
                        'notes'             => $row['surname'], // this is yellow row SP number
                        'course_type_id'    => 1
                    ]
                );
                
            } elseif (!empty($row['date'])) {

                if (!empty($row['company'])){
                    $company = Company::updateOrCreate( 
                        ['name' => $row['company']],
                        ['name' => $row['company']]
                    );

                    if (!empty($row['contact'])){
                        $contact = Contact::updateOrCreate( 
                            ['company_id' => $company->id, 'name' => $row['contact']],
                            ['company_id' => $company->id, 'name' => $row['contact'], 'email' => $row['contact_email'], 'phone' => $row['phone']]
                        );
                    }
                    
                } else {
                    $company = null;
                    $contact = null;
                }

                Booking::create([
                    'date'              => $course->date, 
                    'name'              => !empty($row['forename']) ? $row['forename'] : '',
                    'surname'           => !empty($row['surname']) ? $row['surname'] : '',
                    'phone'             => !empty($company) ? null : $row['phone'],
                    'email'             => !empty($company) ? null : $row['contact_email'],
                    'pps'               => true,
                    'rate'              => !empty($row['rate']) ? (Int) $row['rate'] : (Int) 0,

                    'course_id'         => $course->id, 
                    'company_id'        => !empty($company) ? $company->id : null,
                    'contact_id'        => !empty($contact) ? $contact->id : null,
                    'po'                => $row['po'],
                    'invoice_id'        => null,
                    'confirmation_sent' => $course->date,
                    'reminder_sent'     => $course->date,
                    'pps_reminder_sent' => $course->date,
                    'confirmed'         => true,
                    'no_show'           => false,
                    'user_id'           => 1,
                    'comments'          => null,
                    
                 ]);
            }
        }

        $bar->finish();
        error_log("\n");
        
    }
}
