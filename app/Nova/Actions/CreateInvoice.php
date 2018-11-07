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

        foreach ($models as $model) {

            if ($model->isMissingInvoice()){
                $models->forget($model->id);
            }
        
        }

        if ($models->isEmpty()) {
            return Action::danger('All bookings have corresponding invoices!');
        }

        // generate invoice number

        // $lastInvoiceID = \App\Invoice::orderBy('number', 'DESC')->pluck('number')->first();
        // $newInvoiceID = $lastInvoiceID ? 1 : $lastInvoiceID + 1;

        // create invoice record in database

        $invoice = \App\Invoice::create([
            'prefix' => 'N-',
            'date' => Carbon::now(),
            'status' => 'new'
        ]);

        foreach ($models as $model) {

            $model->save([
                'invoice_id' => $invoice->id
            ]);
        
        }

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
