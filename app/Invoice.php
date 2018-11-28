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
        'date'
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
        return $this->prefix . $this->id;
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    
    public function totalForInvoice()
    {
        return number_format((float)$this->total, 2, '.', '');
    }

}
