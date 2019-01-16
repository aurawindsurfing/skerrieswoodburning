<?php
namespace App\Http\Traits;

trait UpdatesInvoiceStatus
{
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {

            static::changeInvoiceStatus($model);

        });

        static::deleted(function ($model) {
            
            static::changeInvoiceStatus($model);

        });
    }

    private static function changeInvoiceStatus($model)
    {
        // check if corresponding invoice status should be paid
        $booked = 0;
        $paid = 0;
        $credited = 0;

            foreach ($model->invoice->bookings as $booking ) {
                $booked = $booked + $booking->rate;
            }

            foreach ($model->invoice->payments as $invoice_payment ) {
                if ($invoice_payment->status == 'completed') {
                    $paid = $paid + $invoice_payment->amount;
                }
            }

            foreach ($model->invoice->credit_notes as $credit_note ) {
                if ($credit_note->status == 'issued') {
                    $credited = $credited + $credit_note->amount;
                }
            }

        ($booked - $paid - $credited) <= 0 ? ($model->invoice->update(['status' => 'paid'])) : ($model->invoice->update(['status' => 'unpaid']));
        
    }
}
