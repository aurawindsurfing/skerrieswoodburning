<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function punter()
    {
        return $this->hasOne('App\Punter');
    }

    public function course()
    {
        return $this->hasOne('App\Course');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    

}
