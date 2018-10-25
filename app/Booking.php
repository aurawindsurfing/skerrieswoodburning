<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Booking extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function punter()
    {
        return $this->hasOne('App\Punter');
    }

    public function course()
    {
        return $this->hasOne('App\Course');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    

}
