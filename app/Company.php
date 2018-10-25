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

    public function punters()
    {
        return $this->belongsTo('App\Punter');
    }


}
