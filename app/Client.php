<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function payment()
    {
        return $this->hasManyThrough('App\Payment', 'App\Booking');
    }

    public function booking()
    {
        return $this->hasMany('App\Booking');
    }

}
