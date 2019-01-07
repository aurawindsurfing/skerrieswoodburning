<?php

namespace App\Imports;

use App\Booking;
use App\Company;
use App\Contact;
use App\Course;
use App\Tutor;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Invoice;
use App\Payment;

class BookingImport implements ToCollection, WithHeadingRow
{

    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows)
    {
        $output = new ConsoleOutput();
        error_log('Importing bookings');
        $bar = new ProgressBar($output, $rows->count());

        foreach ($rows as $row) {

            $bar->advance();

            if (str_contains($row['date'], ['Eugene Hughes', 'John Kennedy', 'Michael Clarke']) && !empty($row['date'])) {
                $tutor = Tutor::updateOrCreate(
                    ['name' => $row['date']], // this is yellow tutors name
                    ['phone' => null, 'email' => null]
                );

                $venue = Venue::updateOrCreate(
                    ['name' => $row['forename']], // this is yellow venue name
                    ['name' => $row['forename']]
                );

                $date = explode("2017 ", $row['company']);

                $course = Course::updateOrCreate(
                    [
                        'date' => Carbon::parse($date[0] . '2017')->format('Y-m-d'), // this is yellow course date
                        'venue_id' => $venue->id,
                        'tutor_id' => $tutor->id],
                    [
                        'time' => '00:00:00',
                        'price' => 0,
                        'notes' => $row['surname'] . ' - ' . count($date) > 1 ? $date[1] : '', // this is yellow row SP number
                        'course_type_id' => 1,
                    ]
                );

            } elseif (str_contains($row['date'], ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']) && !empty($row['date'])) {

                // tryin to create a company if exists on the row
                if (!empty($row['company'])) {
                    $company = Company::updateOrCreate(
                        ['name' => $row['company']],
                        ['name' => $row['company']]
                    );

                    if (!empty($row['contact'])) {
                        $contact = Contact::updateOrCreate(
                            ['company_id' => $company->id, 'name' => $row['contact']],
                            ['company_id' => $company->id, 'name' => $row['contact'], 'email' => $row['contact_email'], 'phone' => $row['phone']]
                        );
                    }

                } else {
                    $company = null;
                    $contact = null;
                }

                if (!empty($row['invoice'])) {
                    $invoice = Invoice::updateOrCreate(
                        ['number' => preg_replace('/[^0-9.]+/', '', $row['invoice'])],
                        ['prefix' => 'SI-',
                        'company_id' => !empty($company) ? $company->id : null,
                        'date' => $course->date,
                        // 'total' => 100,
                        'status' => 'paid',
                        'user_id' => 1
                        ]
                    );
                }

                $booking = Booking::create([
                    'date' => $course->date,
                    'name' => !empty($row['forename']) ? $row['forename'] : null,
                    'surname' => !empty($row['surname']) ? $row['surname'] : null,
                    'phone' => !empty($company) ? null : preg_replace('/[^0-9.]+/', '', $row['phone']),
                    'email' => !empty($company) ? null : $row['contact_email'],
                    'pps' => true,
                    'rate' => !empty($row['rate']) ? (Int) $row['rate'] : (Int) 0,

                    'course_id' => $course->id,
                    'company_id' => !empty($company) ? $company->id : null,
                    'contact_id' => !empty($contact) ? $contact->id : null,
                    'po' => $row['po'],
                    'invoice_id' => !empty($row['invoice']) ? $invoice->id : null,
                    'student_notified' => true,
                    'company_contact_notified' => true, 
                    'confirmation_sent' => $course->date,
                    'reminder_sent' => $course->date,
                    'pps_reminder_sent' => $course->date,
                    'confirmed' => true,
                    'no_show' => false,
                    'user_id' => 1,
                    'comments' => null,

                ]);

                if (!empty($row['invoice'])) {
                    $invoice->total = $invoice->total + $booking->rate;
                    $invoice->save();

                    $payment = Payment::create([
                        'amount' => $booking->rate,
                        'invoice_id' => $invoice->id,
                        'payment_method' => !empty($row['actually_paid']) ? $row['actually_paid'] : 'cash',
                        'status' => 'completed' 
                        ]
                    );
                }

            } else {

            }
        }

        $bar->finish();
        error_log("\n");

    }
}
