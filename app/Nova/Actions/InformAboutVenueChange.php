<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Contact;
use Propaganistas\LaravelPhone\PhoneNumber;

class InformAboutVenueChange extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //split bookings private / company
        $student_bookings = $models->first()->bookings()->whereCompanyId(null)->whereNotNull('phone')->get();
        $companies_bookings = $models->first()->bookings()->whereNotNull('company_id')->get();
        $companies_bookings = $companies_bookings->groupBy('contact_id');

        //notify single
        error_log('Trying to notify ' . $student_bookings->count() . ' students');

        foreach ($student_bookings as $booking) {
            if (PhoneNumber::make($booking->phone, config('nexmo.countries'))->isOfType('mobile')) {
                $booking->notify(new \App\Notifications\VenueChange);
            }
        }

        //notify companies with one notificaion
        error_log('Trying to notify ' . $companies_bookings->count() . ' company contacts');

        $missing_company_contacts = 0;

        foreach ($companies_bookings as $contact_id => $bookings) {
            $contact = Contact::find($contact_id);
            if (isset($contact)) {
                $contact->notify(new \App\Notifications\CompanyVenueChange($bookings));
            } else {
                $missing_company_contacts = $missing_company_contacts + 1;
            }
            
        };

        if ($missing_company_contacts > 0) {
            return Action::danger($missing_company_contacts . ' companies are missing contact details! Failed to notify them about venue change!');
        } else {
            return Action::message('All notifications sent with venue change info');
        }

        

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
