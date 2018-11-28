<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($payment) {
            
            $payment->status = 'completed';
    
        });

        static::saved(function ($payment) {

            static::changeInvoiceStatus($payment);

        });

        static::deleted(function ($payment) {
            
            static::changeInvoiceStatus($payment);

        });
    }

    private static function changeInvoiceStatus($payment)
    {
        // check if corresponding invoice status should be paid
        $booked = 0;
        $paid = 0;

            foreach ($payment->invoice->bookings as $booking ) {
                $booked = $booked + $booking->rate;
            }

            foreach ($payment->invoice->payments as $payment ) {
                if ($payment->status == 'completed') {
                    $paid = $paid + $payment->amount;
                }
            }

        ($booked - $paid) <= 0 ? $payment->invoice->update(['status' => 'paid']) : $payment->invoice->update(['status' => 'unpaid']);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

}
