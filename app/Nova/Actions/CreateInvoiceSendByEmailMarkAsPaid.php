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
        $count = 0;

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
                    foreach ($company_bookings as $booking) {
                        $booking->createPayment($invoice->id);
                    }
                    $count++;

                }
            }

            // individual bookings

            if (!is_null($bookings_without_company) && $bookings_without_company->isNotEmpty()) {
                foreach ($bookings_without_company as $booking) {
                    $invoice = $invoiceController->createSingleBookingInvoice($booking);
                    $booking->createPayment($invoice->id);
                    $count++;
                }
            }

        }

        $invoices = collect([]);

        foreach ($models as $booking) {
            $invoice = $booking->invoice;
            $invoices = $invoices->push($invoice);
        }

        $invoices = $invoices->unique();
        $i = 0;

        foreach ($invoices as $invoice) {

            $invoice->update(['status' => 'paid']);
            $inv = collect([$invoice]);

            $invoicePDF = new \App\Http\Controllers\InvoiceController();
            $path = $invoicePDF->makePDF($inv);

            $data = [
                'invoice_number' => $invoice->number(),
                'user_name' => $invoice->user->name,
                'path' => $path,
            ];

            Mail::to('tomcentrumpl@gmail.com')
                ->cc('alec@citltd.ie')
                ->queue(new \App\Mail\NewInvoice($data));
            $i++;
        }

        return Action::message('Created and marked as paid ' . $count . ' invoices. Emailing ' . $i . ' invoices now.');

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
