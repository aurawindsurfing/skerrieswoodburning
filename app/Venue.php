<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;
use Spatie\Activitylog\Traits\LogsActivity;

class Venue extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use Sluggable;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name', 'address_line_1', 'city', 'postal_code']
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

    public function course_dates()
    {
        return $this->hasMany(\App\CourseDate::class);
    }

    public function fullAddress()
    {
        return $this->address_line_1.' '.$this->city.' '.$this->postal_code;
    }

    public function image_url()
    {
        return empty($this->photo)
            ? Cloudder::secureShow('gazeta/ogloszenia/user-avatar', config('settings.cloudinary_optimised_jpg'))
            : Cloudder::secureShow('' . Str::beforeLast($this->photo, '.'), config('settings.cloudinary_optimised_jpg'));
    }
}
