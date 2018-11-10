<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;
    
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
