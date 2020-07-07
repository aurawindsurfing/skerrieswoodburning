<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;
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

    public function image_url()
    {
        return empty($this->icon)
            ? Cloudder::secureShow('gazeta/ogloszenia/user-avatar', config('settings.cloudinary_course_group'))
            : Cloudder::secureShow('' . Str::beforeLast($this->icon, '.'), config('settings.cloudinary_course_group'));
    }

}
