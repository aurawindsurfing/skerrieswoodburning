<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function bookings()
    {
        return $this->belongsTo('App\Booking');
    }

    public function punters()
    {
        return $this->belongsTo('App\Punter');
    }


}
