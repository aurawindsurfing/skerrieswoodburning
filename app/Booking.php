<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Propaganistas\LaravelPhone\PhoneNumber;

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

    // if multiday then we coalate all dates into a collection of dates and we sort them asc by date then we ase that to send notifications

    public function upcoming_course_dates()
    {

        $dates = collect([]);

        if ($this->course->date > Carbon::now()) {
            
            $course_date = new CourseDate;
            $course_date->course_id = $this->course->id;
            $course_date->venue_id = $this->course->venue->id;
            $course_date->date = $this->course->date;
            $course_date->time = $this->course->time;
            $dates->push($course_date); /// trzeba z tego zrobic taki sam objekt jak coursedates
        }

        
        if ($this->course->multiday) {
            foreach ($this->course->course_dates()->get() as $course_date) {
                if ($course_date->date > Carbon::now()){
                    $dates->push($course_date);
                }
            }
        }

        $sorted_course_dates = $dates->sortBy(function ($course_date) {
            return $course_date->date;
        });

        return $sorted_course_dates;

    }
 

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        $phone = PhoneNumber::make($this->phone, config('nexmo.countries'))->formatE164();

        return ltrim($phone, '+');
    }

}
