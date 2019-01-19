<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    use SoftDeletes, LogsActivity, Notifiable;

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

            isset($booking->contact) ? $booking->company_id = $booking->contact->company->id : null;
            
            if (Auth::check()){
                $booking->user_id = Auth::user()->id;
            }
            
            session(['booking' => $booking]);
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

    public function payments()
    {
        return $this->hasMany('App\Payment');
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

    public function notification_log()
    {
        return $this->hasMany('App\NotificationLog');
    }

    public function invoiceDescription()
    {
        return $this->name . ' ' . $this->surname .' - '. $this->course->course_type->name . ' - '. $this->course->date->format('Y-m-d') . (isset($this->po) ? ' PO: ' . $this->po : '');
    }

    public function rateForInvoice()
    {
        return number_format((float)$this->rate, 2, '.', '');
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
