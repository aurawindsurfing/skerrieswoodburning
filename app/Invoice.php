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

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }

    public function items()
    {
        return $this->hasMany('App\InvoiceItem');
    }
}
