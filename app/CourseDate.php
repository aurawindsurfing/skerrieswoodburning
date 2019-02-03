<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CourseDate extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }
}
