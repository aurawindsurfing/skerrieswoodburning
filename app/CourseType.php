<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MichielKempen\NovaOrderField\Orderable;
use Spatie\Activitylog\Traits\LogsActivity;

class CourseType extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use Orderable;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function courses()
    {
        return $this->hasMany(\App\Course::class);
    }

    public function courseTypeGroup()
    {
        return $this->belongsTo(\App\CourseTypeGroup::class);
    }
}
