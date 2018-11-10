<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Tutor extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function courseTypes()
    {
        return $this->hasManyThrough('App\CourseType', 'App\Course');
    }

}
