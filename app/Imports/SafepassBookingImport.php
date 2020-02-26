<?php

namespace App\Imports;

use App\Booking;
use App\Company;
use App\Contact;
use App\Course;
use App\CourseType;
use App\Invoice;
use App\Payment;
use App\Tutor;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class SafepassBookingImport implements ToCollection, WithHeadingRow
{
    public function chunkSize(): int
    {
        return 500;
    }

    public function collection(Collection $rows)
    {
        $output = new ConsoleOutput();
        error_log('Importing safepass bookings');
        $bar = new ProgressBar($output, $rows->count());

        $course_type_id = CourseType::whereName('Safepass')->pluck('id')->first();

        foreach ($rows as $row) {
            $bar->advance();

            if (str_contains($row['date'], ['Eugene Hughes', 'John Kennedy', 'Michael Clarke', 'Chriss Mee', 'Martin Cooper', 'Stephen Browne', 'Noel Gannon']) && ! empty($row['date'])) {
                $tutor = Tutor::updateOrCreate(
                    ['name' => $row['date']], // this is yellow tutors name
                    ['phone' => null, 'email' => null]
                );

                $venue = Venue::updateOrCreate(
                    ['name' => $row['forename']], // this is yellow venue name
                    ['name' => $row['forename']]
                );

                $date = explode(' - ', $row['company'], 2);

                $inHouse = ((count($date) > 1) ? str_contains(strtolower($date[1]), 'house') : false) || str_contains(strtolower($row['forename']), 'In-House');
                $course_date_ready_for_parsing = str_replace(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], '', $date[0]);

                $course = Course::updateOrCreate(
                    [
                        'date' => Carbon::parse($course_date_ready_for_parsing)->format('Y-m-d'), // this is yellow course date
                        'venue_id' => $venue->id,
                        'tutor_id' => $tutor->id,
                    ],
                    [
                        'time' => '08:00:00',
                        'price' => 115,
                        'notes' => $row['surname'].' - '.count($date) > 1 ? $date[1] : '', // this is yellow row SP number
                        'course_type_id' => $course_type_id,
                        'cancelled' => strtolower($row['surname']) == 'cancelled' ? true : false,
                        'inhouse' => $inHouse,
                    ]
                );
            } elseif (str_contains($row['date'], ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']) && ! empty($row['date'])) {

                // tryin to create a company if exists on the row
                if (! empty($row['company'])) {
                    $company = Company::updateOrCreate(
                        ['name' => $row['company']],
                        ['name' => $row['company']]
                    );

                    if (! empty($row['contact'])) {
                        $contact = Contact::updateOrCreate(
                            ['company_id' => $company->id, 'name' => $row['contact']],
                            ['company_id' => $company->id, 'name' => $row['contact'], 'email' => $row['contact_email'], 'phone' => preg_replace('/[^0-9.]+/', '', $row['phone'])]
                        );
                    }
                } else {
                    $company = null;
                    $contact = null;
                }

                if (! empty($row['invoice']) && is_numeric($row['invoice'])) {
                    $invoice = Invoice::updateOrCreate(
                        ['number' => preg_replace('/[^0-9.]+/', '', $row['invoice'])],
                        ['prefix' => 'SI-',
                        'company_id' => ! empty($company) ? $company->id : null,
                        'date' => $course->date,
                        // 'total' => 100,
                        'status' => 'paid',
                        'user_id' => 1,
                        ]
                    );
                }

                if (! empty($row['forename']) || ! empty($row['surname']) || ! empty($row['company'])) {
                    $booking = Booking::create([
                        'date' => $course->date,
                        'name' => ! empty($row['forename']) ? $row['forename'] : null,
                        'surname' => ! empty($row['surname']) ? $row['surname'] : null,
                        'phone' => ! empty($company) ? null : preg_replace('/[^0-9.]+/', '', $row['phone']),
                        'email' => ! empty($company) ? null : $row['contact_email'],
                        'pps' => true,
                        'rate' => (! empty($row['rate']) && is_numeric($row['rate'])) ? (int) $row['rate'] : (int) 0,

                        'course_id' => $course->id,
                        'company_id' => ! empty($company) ? $company->id : null,
                        'contact_id' => ! empty($contact) ? $contact->id : null,
                        'po' => $row['po'],
                        'invoice_id' => ! empty($row['invoice']) ? $invoice->id : null,
                        'student_notified' => true,
                        'company_contact_notified' => true,
                        // 'confirmation_sent' => $course->date,
                        'reminders_sent' => true,
                        'pps_reminder_sent' => true,
                        'confirmed' => true,
                        'no_show' => false,
                        'user_id' => 1,
                        'comments' => ! empty($row['comment']) ? $row['comment'] : null,

                    ]);
                }

                if (! empty($row['invoice']) && is_numeric($row['invoice'])) {
                    $invoice->total = $invoice->total + $booking->rate;
                    $invoice->save();

                    if (! empty($row['actually_paid'])) {
                        if (str_contains('cash', $row['actually_paid'])) {
                            $payment_method = 'cash';
                        } elseif (str_contains($row['actually_paid'], 'Inv')) {
                            $payment_method = 'eft';
                        } elseif (str_contains($row['actually_paid'], 'CC')) {
                            $payment_method = 'cc';
                        } elseif (str_contains($row['actually_paid'], 'chq')) {
                            $payment_method = 'cheque';
                        } elseif (str_contains($row['actually_paid'], 'ch')) {
                            $payment_method = 'cheque';
                        } elseif (str_contains($row['actually_paid'], 'cheq')) {
                            $payment_method = 'cheque';
                        }
                    } else {
                        $payment_method = 'cash';
                    }

                    if ($booking->rate > 0) {
                        $payment = Payment::create([
                            'amount' => $booking->rate,
                            'invoice_id' => $invoice->id,
                            'payment_method' => $payment_method,
                            'status' => 'completed',
                            ]
                        );
                    }
                }
            } else {
            }
        }

        $bar->finish();
        error_log("\n");
    }
}
