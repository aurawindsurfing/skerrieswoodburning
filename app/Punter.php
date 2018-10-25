<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punter extends Model
{
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }



}
