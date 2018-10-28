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

    public function paymentMethod()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }


}
