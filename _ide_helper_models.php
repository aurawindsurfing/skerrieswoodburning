<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\NotificationLog
 *
 * @property int $id
 * @property int|null $booking_id
 * @property int|null $invoice_id
 * @property string $subject
 * @property string $type
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $confirmation_sent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Booking|null $booking
 * @property-read \App\Invoice|null $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereConfirmationSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NotificationLog whereUpdatedAt($value)
 */
	class NotificationLog extends \Eloquent {}
}

namespace App{
/**
 * App\Venue
 *
 * @property int $id
 * @property string $name
 * @property string|null $address_line_1
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $photo
 * @property string|null $geo
 * @property string|null $google_maps
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CourseDate[] $course_dates
 * @property-read int|null $course_dates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read int|null $courses_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Venue onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereGeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereGoogleMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Venue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Venue withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Venue withoutTrashed()
 */
	class Venue extends \Eloquent {}
}

namespace App{
/**
 * App\Booking
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $phone
 * @property string|null $email
 * @property int $pps
 * @property int $rate
 * @property string|null $payment_type
 * @property int $course_id
 * @property int|null $company_id
 * @property int|null $contact_id
 * @property string|null $po
 * @property string|null $invoice_id
 * @property int $student_notified
 * @property int $company_contact_notified
 * @property int $reminders_sent
 * @property int $company_contact_reminders_sent
 * @property int $pps_reminder_sent
 * @property int $confirmed
 * @property int $no_show
 * @property int|null $user_id
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Company|null $company
 * @property-read \App\Contact|null $contact
 * @property-read \App\Course $course
 * @property-read \App\Invoice|null $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NotificationLog[] $notification_log
 * @property-read int|null $notification_log_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\User|null $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCompanyContactNotified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCompanyContactRemindersSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereNoShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePpsReminderSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereRemindersSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereStudentNotified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Booking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Booking withoutTrashed()
 */
	class Booking extends \Eloquent {}
}

namespace App{
/**
 * App\CourseDate
 *
 * @property int $id
 * @property int $course_id
 * @property int $venue_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $time
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Course $course
 * @property-read \App\Venue $venue
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CourseDate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseDate whereVenueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CourseDate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CourseDate withoutTrashed()
 */
	class CourseDate extends \Eloquent {}
}

namespace App{
/**
 * App\CourseTypeGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property int|null $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CourseType[] $course_types
 * @property-read int|null $course_types_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup ordered($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseTypeGroup whereUpdatedAt($value)
 */
	class CourseTypeGroup extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $booking
 * @property-read int|null $booking_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Contact
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property int|null $accounts_payable
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \App\Company|null $company
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereAccountsPayable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Contact withoutTrashed()
 */
	class Contact extends \Eloquent {}
}

namespace App{
/**
 * App\CreditNote
 *
 * @property int $id
 * @property string $prefix
 * @property int|null $invoice_id
 * @property float|null $amount
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Invoice|null $invoice
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditNote onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CreditNote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CreditNote withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CreditNote withoutTrashed()
 */
	class CreditNote extends \Eloquent {}
}

namespace App{
/**
 * App\Payment
 *
 * @property int $id
 * @property int $amount
 * @property int|null $invoice_id
 * @property string $payment_method
 * @property string|null $reference
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Invoice|null $invoice
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App{
/**
 * App\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $tax
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $payment_method
 * @property int|null $payment_terms
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $accounts_payable
 * @property-read int|null $accounts_payable_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invoice[] $unpaid_invoices
 * @property-read int|null $unpaid_invoices_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Company withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Company withoutTrashed()
 */
	class Company extends \Eloquent {}
}

namespace App{
/**
 * App\Invoice
 *
 * @property int $id
 * @property string $prefix
 * @property int|null $number
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $payment_terms
 * @property float|null $total
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \App\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CreditNote[] $credit_notes
 * @property-read int|null $credit_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CreditNote[] $credit_notes_issued
 * @property-read int|null $credit_notes_issued_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NotificationLog[] $notification_log
 * @property-read int|null $notification_log_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments_completed
 * @property-read int|null $payments_completed_count
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Invoice whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice withoutTrashed()
 */
	class Invoice extends \Eloquent {}
}

namespace App{
/**
 * App\Course
 *
 * @property int $id
 * @property int|null $tutor_id
 * @property int $venue_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $time
 * @property int $price
 * @property int|null $inhouse
 * @property int|null $multiday
 * @property int|null $cancelled
 * @property int|null $capacity
 * @property string|null $notes
 * @property int|null $course_type_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CourseDate[] $course_dates
 * @property-read int|null $course_dates_count
 * @property-read \App\CourseType|null $course_type
 * @property-read \App\Tutor|null $tutor
 * @property-read \App\Venue $venue
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Course onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCourseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereInhouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereMultiday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereVenueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Course withoutTrashed()
 */
	class Course extends \Eloquent {}
}

namespace App{
/**
 * App\ActivityLog
 *
 * @property int $id
 * @property string|null $log_name
 * @property string $description
 * @property int|null $subject_id
 * @property string|null $subject_type
 * @property int|null $causer_id
 * @property string|null $causer_type
 * @property string|null $properties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivityLog whereUpdatedAt($value)
 */
	class ActivityLog extends \Eloquent {}
}

namespace App{
/**
 * App\CourseType
 *
 * @property int $id
 * @property string $name
 * @property int|null $course_type_group_id
 * @property string|null $title
 * @property string|null $tutor_title
 * @property int $default_rate
 * @property string|null $objectives
 * @property string|null $who_should_attend
 * @property string|null $delegates
 * @property string|null $outline
 * @property string|null $duration
 * @property string|null $certification
 * @property string|null $what_to_bring
 * @property string|null $start_time
 * @property string|null $plan_of_the_day
 * @property int|null $valid_for_years
 * @property int $capacity
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\CourseTypeGroup|null $course_type_group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read int|null $courses_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CourseType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereCertification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereCourseTypeGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereDefaultRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereDelegates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereObjectives($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereOutline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType wherePlanOfTheDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereTutorTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereValidForYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereWhatToBring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CourseType whereWhoShouldAttend($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CourseType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CourseType withoutTrashed()
 */
	class CourseType extends \Eloquent {}
}

namespace App{
/**
 * App\Tutor
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CourseType[] $courseTypes
 * @property-read int|null $course_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read int|null $courses_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Tutor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tutor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tutor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Tutor withoutTrashed()
 */
	class Tutor extends \Eloquent {}
}

