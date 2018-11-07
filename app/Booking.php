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

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
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

    public function invoiceDescription()
    {
        return $this->name . ' ' . $this->surname .' - '. $this->course->course_type->name . ' - '. $this->course->date->format('Y-m-d');
    }

}
