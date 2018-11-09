<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

}
