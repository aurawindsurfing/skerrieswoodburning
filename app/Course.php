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

    protected $dates = [
        'date',
    ];
    
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Tutor');
    }

    public function courseType()
    {
        return $this->belongsTo('App\CourseType');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
    
}
