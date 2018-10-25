<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;
    
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
