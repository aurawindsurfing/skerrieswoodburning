<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{

    protected $table = 'notification_log';

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }
}
