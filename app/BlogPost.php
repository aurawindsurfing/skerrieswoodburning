<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class BlogPost extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image_url()
    {
        return empty($this->image)
            ? Cloudder::secureShow('gazeta/ogloszenia/user-avatar', config('settings.cloudinary_optimised_jpg'))
            : Cloudder::secureShow('' . Str::beforeLast($this->image, '.'), config('settings.cloudinary_optimised_jpg'));
    }
}
