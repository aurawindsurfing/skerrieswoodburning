<?php

namespace App\Imports;

use App\Booking;
use App\Company;
use App\Contact;
use App\Course;
use App\Tutor;
use App\Venue;
use App\Invoice;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Support\Collection;

use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\CourseType;


class OtherCoursesBookingImport implements ToCollection, WithHeadingRow
{

    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows)
    {
        $output = new ConsoleOutput();
        error_log('Importing other course bookings');
        $bar = new ProgressBar($output, $rows->count());

        foreach ($rows as $row) {

            $bar->advance();

            if (!empty($row['instructor'])) {
                $tutor = Tutor::updateOrCreate(
                    ['name' => $row['instructor']], 
                    ['phone' => null, 'email' => null]
                );
            } else {
                $tutor = Tutor::updateOrCreate(
                    ['name' => 'SP1'], 
                    ['phone' => null, 'email' => null]
                );
            }

            if (!empty($row['venue'])) {
                $venue = Venue::updateOrCreate(
                    ['name' => $row['venue']], 
                    ['name' => $row['venue']]
                );
            } else {
                $venue = Venue::updateOrCreate(
                    ['name' => 'CIT'], 
                    ['name' => 'CIT']
                );
            }

            $course_type = CourseType::updateOrCreate(
                ['name' => $row['type']], 
                ['name' => $row['type']]
            );

            if (!empty($row['date'])) {
                $date = Carbon::createFromFormat('d m Y', $row['date'])->format('Y-m-d');
            } else {
                $date = Carbon::parse('01-01-1999')->format('Y-m-d');
            }

            $course = Course::updateOrCreate(
                [
                    'date' => $date, 
                    'venue_id' => $venue->id,
                    'tutor_id' => $tutor->id
                ],
                [
                    'time' => '08:00:00',
                    'price' => 0,
                    'notes' => ($row['duration'] ?? ''), 
                    'course_type_id' => $course_type->id,
                    'cancelled' => false,
                ]
            );


            // tryin to create a company if exists on the row
            if (!empty($row['company'])) {

                $company_name = $row['company'] . ($row['section'] ?? '') . ($row['subsection'] ?? '');

                $company = Company::updateOrCreate(
                    ['name' => $company_name],
                    ['name' => $company_name, 'address' => $row['depot'] ?? '']
                );

                $contact = null;

            } else {
                $company = null;
                $contact = null;
            }


            $booking = Booking::create([
                'date' => $course->date,
                'name' => !empty($row['forename']) ? $row['forename'] : null,
                'surname' => !empty($row['surname']) ? $row['surname'] : null,
                'phone' => null,
                'email' => null,
                'pps' => true,
                'rate' => 0,

                'course_id' => $course->id,
                'company_id' => !empty($company) ? $company->id : null,
                'contact_id' => !empty($contact) ? $contact->id : null,
                'po' => $row['po'],
                'invoice_id' => null,
                'student_notified' => true,
                'company_contact_notified' => true, 
                // 'confirmation_sent' => $course->date,
                'reminders_sent' => true,
                'pps_reminder_sent' => true,
                'confirmed' => true,
                'no_show' => false,
                'user_id' => 1,
                'comments' => 
                        ($row['cert'] ? 'Cert: ' . $row['cert'] : '') . 
                        ($row['solas'] ? ', Solas: ' . $row['cert'] : '') . 
                        ($row['cert_sent'] ? ', Cert Sent: ' . $row['cert_sent'] : '') .
                        ($row['status'] ? ', Status: ' . $row['status'] : '') .
                        ($row['format'] ? ', Format: ' . $row['format'] : '') .
                        ($row['wording'] ? ', Cert Wording: ' . $row['wording'] : '') .
                        ($row['result'] ? ', Result: ' . $row['result'] : '') .
                        ($row['day3'] ? ', Day 3: ' . $row['day3'] : '') .
                        ($row['practical'] ? ', Practical Date: ' . $row['practical'] : '') .
                        ($row['remarks'] ? ', Remarks: ' . $row['remarks'] : '') .
                        ($row['filter'] ?? ''),
            ]);

            
        }

        $bar->finish();
        error_log("\n");

    }
}
