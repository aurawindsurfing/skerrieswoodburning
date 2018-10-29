<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;

class Booking extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date'
    ];

    protected $casts = [
        'confirmation_sent' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($booking) {
            $booking->date = now();
            if (Auth::check()){
                $booking->user_id = Auth::user()->id;
            }
            
            
        });
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'id', 'payment_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    

}
