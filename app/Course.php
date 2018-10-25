<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function venue()
    {
        return $this->hasOne('App\Venue');
    }

    public function tutor()
    {
        return $this->hasOne('App\Tutor');
    }

    public function courseType()
    {
        return $this->hasOne('App\CourseType');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    
}
