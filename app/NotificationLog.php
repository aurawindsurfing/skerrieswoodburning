<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $table = 'notification_log';

    protected $guarded = [];

    protected $casts = [
        'confirmation_sent' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(\App\Booking::class);
    }

    public function invoice()
    {
        return $this->belongsTo(\App\Invoice::class);
    }
}
