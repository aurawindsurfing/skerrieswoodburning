<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CreateAndDownloadInvoices extends Action
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
            if (is_null($booking->invoice_id)) {
                $uninvoiced_bookings->push($booking);
            }
        }

        if ($uninvoiced_bookings->isNotEmpty()) {

            $invoiceController = new \App\Http\Controllers\InvoiceController();

            $bookings = $uninvoiced_bookings->groupBy('company_id');
            $bookings_without_company = $bookings->pull('');

            //corporate booking

            if (!is_null($bookings) && $bookings->isNotEmpty()) {
                foreach ($bookings as $company_bookings) {
                    $invoice = $invoiceController->createMultipleBookingsInvoice($company_bookings);
                }
            }

            // individual bookings

            if (!is_null($bookings_without_company) && $bookings_without_company->isNotEmpty()) {
                foreach ($bookings_without_company as $booking) {
                    $invoice = $invoiceController->createSingleBookingInvoice($booking);
                }
            }

        }

        $invoices = collect([]);

        foreach ($models as $booking ) {
            $invoice = $booking->invoice;
            $invoices->push($invoice);
        }

        $invoices = $invoices->unique();

        $invoicePDF = new \App\Http\Controllers\InvoiceController();

        $path = $invoicePDF->makePDF($invoices);

        return Action::download(url($path), uniqid() . '.pdf');

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
