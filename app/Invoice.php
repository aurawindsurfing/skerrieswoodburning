<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function number()
    {
        return $this->prefix.(isset($this->number) ? $this->number : $this->id);
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function payments_completed()
    {
        return $this->hasMany('App\Payment')->whereStatus('completed');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function credit_notes()
    {
        return $this->hasMany('App\CreditNote');
    }

    public function credit_notes_issued()
    {
        return $this->hasMany('App\CreditNote')->whereStatus('issued');
    }

    public function balance_due()
    {
        return $this->total - $this->payments_completed->sum('amount') - $this->credit_notes_issued->sum('amount');
    }

    public function notification_log()
    {
        return $this->hasMany('App\NotificationLog');
    }

    public function totalForInvoice()
    {
        return number_format((float) $this->total, 2, '.', '');
    }

    public function paymentsMadeForInvoice()
    {
        return number_format((float) $this->payments_completed->sum('amount'), 2, '.', '');
    }

    public function creaditNotesIssuedForInvoice()
    {
        return number_format((float) $this->credit_notes_issued->sum('amount'), 2, '.', '');
    }

    public function balanceDueForInvoice()
    {
        return number_format((float) $this->balance_due(), 2, '.', '');
    }
}
