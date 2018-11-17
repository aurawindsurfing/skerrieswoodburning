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

// class CreateInvoiceSendByEmailMarkAsPaid extends Action implements ShouldQueue
class CreateInvoiceSendByEmailMarkAsPaid extends Action
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

        $uninvoiced_bookings = collect([]);

        foreach ($models as $booking) {
            if (is_null($booking->invoice_id)){
                $uninvoiced_bookings->push($booking);
            } 
        }

        if ($uninvoiced_bookings->isNotEmpty()) {

            $invoiceController = new \App\Http\Controllers\InvoiceController();
            $count = 0;

            $bookings = $uninvoiced_bookings->groupBy('company_id');
            $bookings_without_company = $bookings->pull('');

            //corporate booking

            if (!is_null($bookings) && $bookings->isNotEmpty()) {
                foreach($bookings as $company_bookings){
                    $invoice = $invoiceController->createMultipleBookingsInvoice($company_bookings);
                    
                    Mail::to('tomcentrumpl@gmail.com')
                        // ->cc('tom@gazeta.ie')
                        ->cc('alec@citltd.ie')
                        ->send(new \App\Mail\NewInvoice($invoice));
                    
                    foreach ($company_bookings as $booking) {
                        $booking->createPayment($invoice->id);
                    }
                    
                    $count++;

                }
           }

           // individual bookings

           if (!is_null($bookings_without_company) && $bookings_without_company->isNotEmpty()) {

            foreach($bookings_without_company as $booking){

                $invoice = $invoiceController->createSingleBookingInvoice($booking);
                
                Mail::to('tomcentrumpl@gmail.com')
                    // ->cc('tom@gazeta.ie')
                    ->cc('alec@citltd.ie')
                    ->send(new \App\Mail\NewInvoice($invoice));

                    $booking->createPayment($invoice->id);

                $count++;
            }
       }
       
            return Action::message('Created ' . $count . ' invoices. Marked them as paid. Emailing them now.');
                   
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
