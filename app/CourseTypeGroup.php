<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTypeGroup extends Model
{
    public function course_type()
    {
        return $this->hasOne(\App\CourseType::class);
    }
}
