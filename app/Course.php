<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Scopes\UpcomingOnlyScope;

class Course extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date',
    ];

    public function tutor()
    {
        return $this->belongsTo('App\Tutor');
    }

    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function course_type()
    {
        return $this->belongsTo('App\CourseType');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function course_dates()
    {
        return $this->hasMany('App\CourseDate');
    }

    public function uuid()
    {
        return $this->id . '/' . $this->date->format('Y');
    }

    public function upcoming()
    {
        return $this->date >= now() ? true : false;
    }
    
}
