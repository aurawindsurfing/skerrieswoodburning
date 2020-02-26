<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Venue extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function course_dates()
    {
        return $this->hasMany('App\CourseDate');
    }

    public function fullAddress()
    {
        return $this->address_line_1.' '.$this->city.' '.$this->postal_code;
    }
}
