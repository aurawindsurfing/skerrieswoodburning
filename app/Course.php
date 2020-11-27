<?php

namespace App;

use App\Scopes\UpcomingOnlyScope;
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

    public static function boot() {
        parent::boot();

        static::deleting(function($course) { // before delete() method call this
            $course->bookings()->delete();
            // do the rest of the cleanup...
        });
    }

    public function tutor()
    {
        return $this->belongsTo(\App\Tutor::class);
    }

    public function venue()
    {
        return $this->belongsTo(\App\Venue::class);
    }

    public function course_type()
    {
        return $this->belongsTo(\App\CourseType::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Booking::class);
    }

    public function course_dates()
    {
        return $this->hasMany(\App\CourseDate::class);
    }

    public function uuid()
    {
        return $this->id.'/'.$this->date->format('Y');
    }

    public function upcoming()
    {
        return $this->date >= now() ? true : false;
    }
}
