<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Laravel\Nova\Fields\BelongsTo;
use App\Company;

class CreateInvoice extends Action
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

        // clear boookings that already have a corresponding invoice

        $uninvoiced_bookings = collect([]);

        foreach ($models as $booking) {

            if (is_null($booking->invoice_id)){
                $uninvoiced_bookings->push($booking);
            }
        
        }

        if ($uninvoiced_bookings->isNotEmpty()) {

            $invoiceController = new \App\Http\Controllers\InvoiceController();
            $count = 0;

            // grouping bookings by company and separating individual booking
           $company_bookings = $uninvoiced_bookings->groupBy('company_id');
           $individual_bookings = $company_bookings->pull('');


           if (!is_null($company_bookings) && $company_bookings->isNotEmpty()) {
            
                foreach($company_bookings as $company_booking){

                    $invoiceController->create($company_booking);
                    $count++;

                }

           }

            if(is_null($individual_bookings)){
                return Action::message('Created ' . $count . ' invoices.');
            } else {
                $individual_bookings = $individual_bookings->count();
                return Action::message('Created ' . $count . ' invoices. Skipped ' . $individual_bookings . ' bookings without company.');
            }
        
        } else {

            return Action::danger('Looks like all bookings have corresponding invoices!');
            
        } 

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            
        ];
    }

}
