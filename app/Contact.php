<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use SoftDeletes, LogsActivity, Notifiable;

    protected $guarded = [];

    protected static $logUnguarded = true;
    
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return '353' . ltrim($this->phone, '0');
    }
}
