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

class DownloadInvoice extends Action
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

        foreach ($models as $existingInvoice) {

            if ($existingInvoice->bookings) {

                $invoicePDF = \ConsoleTVs\Invoices\Classes\Invoice::make()
                    ->number($existingInvoice->number());


                foreach ($existingInvoice->bookings as $booking) {
                    $invoicePDF->addItem(
                        $booking->invoiceDescription(), 
                        $booking->rate, 1,
                        $booking->rate);
                }

                if ($existingInvoice->company) {
                    $invoicePDF->customer([
                        'name' => $existingInvoice->company->name ? : '',
                        'id' => $existingInvoice->company->name ? : '',
                        'phone' => $existingInvoice->company->phone ? : '',
                        'location' => $existingInvoice->company->address ? : '',
                        'zip' => '',
                        'city' => '',
                        'country' => '',
                    ]);
                } else {
                    $invoicePDF->customer([
                        'name' => $existingInvoice->booking->name ? : '',
                        'id' => $existingInvoice->booking->pps ? : '',
                        'phone' => $existingInvoice->booking->phone ? : '',
                        'location' => '',
                        'zip' => '',
                        'city' => '',
                        'country' => '',
                    ]);
                }


                $invoicePDF->save('public/tmp/invoices/' . $existingInvoice->number() . '.pdf');

                return 
                
                Action::download(
                    env('APP_URL') . ('/tmp/invoices/') . $existingInvoice->number() . '.pdf',
                    $existingInvoice->number() . '.pdf'
                );

            } else {

                return Action::danger('Something went wrong when trying to download the invoice!');

            }

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
