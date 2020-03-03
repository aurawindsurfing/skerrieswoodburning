<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class CourseTypeGroup extends Model implements Sortable
{
    use SortableTrait;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function course_types()
    {
        return $this->hasMany(\App\CourseType::class);
    }
}
