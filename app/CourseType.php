<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MichielKempen\NovaOrderField\Orderable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class CourseType extends Model implements Sortable
{
    use SoftDeletes;
    use LogsActivity;
    use Orderable;
    use SortableTrait;
    use Sluggable;

    protected $guarded = [];

    protected static $logUnguarded = true;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function buildSortQuery()
    {
        return static::query()->where('course_type_group_id', $this->course_type_group_id);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function courses()
    {
        return $this->hasMany(\App\Course::class);
    }

    public function course_type_group()
    {
        return $this->belongsTo(\App\CourseTypeGroup::class);
    }
}
