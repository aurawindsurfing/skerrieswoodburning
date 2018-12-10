<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

// class CreateInvoiceSendByEmailMarkAsPaid extends Action implements ShouldQueue
class InvoiceSendByEmailMarkPaid extends Action
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

        $invoiceController = new \App\Http\Controllers\InvoiceController();
        $created = $invoiceController->generateInvoices($models, true);
        $email = $invoiceController->emailInvoices($models);

        return Action::message('Created and marked as paid ' . $created . ' invoices. Emailing ' . $email . ' invoices now.');

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
