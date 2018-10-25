<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }

    public function paymentMethod()
    {
        return $this->hasOne('App\PaymentMethod');
    }

    


}
