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
        return $this->belongsTo('App\Booking');
    }

    public function candidates()
    {
        return $this->belongsTo('App\Candidate');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

}
