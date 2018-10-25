<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function courseTypes()
    {
        return $this->hasManyThrough('App\CourseType', 'App\Course');
    }

}
