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

        $bookings = collect([]);

        foreach ($models as $model) {

            if (is_null($model->invoice_id)){
                $bookings->push($model);
            }
        
        }

        if ($bookings->isNotEmpty()) {

            // create invoice record in database

            $invoice = \App\Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'status' => 'new'
            ]);


            foreach ($bookings as $booking) {

                $booking->update([
                    'invoice_id' => $invoice->id
                ]);
            
            }

            // generate invoice number

            // $lastInvoiceID = \App\Invoice::orderBy('number', 'DESC')->pluck('number')->first();
            // $newInvoiceID = $lastInvoiceID ? 1 : $lastInvoiceID + 1;



            // print invoice
    
            $printInvoice = \ConsoleTVs\Invoices\Classes\Invoice::make()->number($invoice->prefix . $invoice->id);
    
    
            foreach ($models as $model) {
                $printInvoice->addItem(
                    $model->invoiceDescription(), 
                    $model->rate, 1,
                    $model->rate);
            }
            
            $printInvoice->customer([
                            'name' => 'Tomasz Lotocki',
                            'id' => '4678434P',
                            'phone' => '+353862194744',
                            'location' => '11 The Tides',
                            'zip' => 'Skerries',
                            'city' => 'Skerries',
                            'country' => 'Ireland', 
                        ]);
            
            
            $printInvoice->save('public/tmp/invoices/' . $invoice->prefix . $invoice->id . '.pdf');

            // Action::message('Invoice created!');

            return Action::download(
                public_path('/tmp/invoices/') . $invoice->prefix . $invoice->id . '.pdf', 
                $invoice->prefix . $invoice->id . '.pdf'
            );
        
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
        return [];
    }
}
