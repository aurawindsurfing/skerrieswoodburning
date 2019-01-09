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
        $student_bookings = $models->first()->bookings()->whereCompanyId(null)->get();
        $companies_bookings = $models->first()->bookings()->whereNotNull('company_id')->get();
        $companies_bookings = $companies_bookings->groupBy('contact_id');

        //notify single
        error_log('Trying to notify ' . $student_bookings->count() . ' students');

        foreach ($student_bookings as $booking) {
            $booking->notify(new \App\Notifications\VenueChange);
        }

        //notify companies with one notificaion
        error_log('Trying to notify ' . $companies_bookings->count() . ' company contacts');

        foreach ($companies_bookings as $contact_id => $bookings) {
            $contact = Contact::find($contact_id);
            $contact->notify(new \App\Notifications\CompanyVenueChange($bookings));
        };

        error_log('Send all company notifications');

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
