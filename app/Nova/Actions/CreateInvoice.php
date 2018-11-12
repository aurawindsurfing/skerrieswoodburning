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

            $customer = $model;
            $company = $customer->company;

            // create invoice record in database

            $invoice = \App\Invoice::create([
                'prefix' => 'N-',
                'date' => Carbon::now(),
                'company_id' => $company ? $company->id : '',
                'status' => 'unpaid',
                'user_id' => $this->user_id ?? auth()->user()->id,
            ]);


            foreach ($bookings as $booking) {

                $booking->update([
                    'invoice_id' => $invoice->id
                ]);

                $invoice->update([
                    'total' => $invoice->total + $booking->rate
                ]);
            
            }

            // generate invoice number

            // $lastInvoiceID = \App\Invoice::orderBy('number', 'DESC')->pluck('number')->first();
            // $newInvoiceID = $lastInvoiceID ? 1 : $lastInvoiceID + 1;

            // download invoice
    
            $printInvoice = \ConsoleTVs\Invoices\Classes\Invoice::make()->number($invoice->prefix . $invoice->id);
    
    
            foreach ($models as $model) {
                $printInvoice->addItem(
                    $model->invoiceDescription(), 
                    $model->rate, 1,
                    $model->rate);
            }
            
            if ($company) {
                $printInvoice->customer([
                    'name'      => $company->name ?: '',
                    'id'        => $company->name ?: '',
                    'phone'     => $company->phone ?: '',
                    'location'  => $company->address ?: '',
                    'zip'       => '',
                    'city'      => '',
                    'country'   => '', 
                ]);
            } else {
                $printInvoice->customer([
                    'name'      => $customer->name ?: '',
                    'id'        => $customer->pps ?: '',
                    'phone'     => $customer->phone ?: '',
                    'location'  => '',
                    'zip'       => '',
                    'city'      => '',
                    'country'   => '', 
                ]);
            }
            
            
            $printInvoice->save('public/tmp/invoices/' . $invoice->prefix . $invoice->id . '.pdf');

            // Action::message('Invoice created!');

            return Action::download(
                env('APP_URL') . ('/tmp/invoices/') . $invoice->prefix . $invoice->id . '.pdf', 
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
        return [
            
        ];
    }
}
