<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;

class CreditNote extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($credit_note) {

            $credit_note->prefix = 'CN-';
            
            if (Auth::check()){
                $credit_note->user_id = Auth::user()->id;
            }
            
        });
    }

    public function invoice()
    {
        return $this->belongsTo('App\Company');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function number()
    {
        return $this->prefix . $this->id;
    }
    
    public function totalForInvoice()
    {
        return number_format((float)$this->total, 2, '.', '');
    }
}
