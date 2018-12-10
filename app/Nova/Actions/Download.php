<?php

namespace App\Nova\Actions;

use App\Http\Controllers\InvoiceController;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Download extends Action
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

        foreach ($models as $model) {

            if ($model->bookings->isEmpty()) {

                return Action::danger('Whoops! One of invoices has NO bookings!');

            }
        }

        $invoicePDF = new InvoiceController();

        $path = $invoicePDF->makePDF($models);

        return Action::download(url($path), uniqid() . '.pdf');

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
