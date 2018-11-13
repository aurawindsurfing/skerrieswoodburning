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
use Illuminate\Support\Facades\Mail;

class CreateInvoiceAndSendByEmail extends Action implements ShouldQueue
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
           $bookings_per_company = $uninvoiced_bookings->groupBy('company_id');
           $individual_bookings = $bookings_per_company->pull('');


           if (!is_null($bookings_per_company) && $bookings_per_company->isNotEmpty()) {
            
                foreach($bookings_per_company as $company_bookings){

                    $invoice = $invoiceController->create($company_bookings);
                    
                    Mail::to('tomcentrumpl@gmail.com')
                        // ->cc('tom@gazeta.ie')
                        // ->cc('alec@citltd.ie')
                        ->send(new \App\Mail\NewInvoice($invoice));

                    $count++;

                }

           }

           if(is_null($individual_bookings)){
                return Action::message('Created ' . $count . ' invoices. Emailing them now.');
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
