<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\InvoiceController;

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

                $invoicePDF = new InvoiceController();
                $invoicePDF->makePDF($existingInvoice);

                return Action::download(
                    url(Storage::url('tmp/invoices/' . $existingInvoice->number() . '.pdf')),
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
