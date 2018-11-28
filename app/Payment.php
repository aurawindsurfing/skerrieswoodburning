<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($payment) {
            
            $payment->status = 'Completed';
            
        });
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

}
