<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\UpdatesInvoiceStatus;

class CreditNote extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use UpdatesInvoiceStatus;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
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
        return number_format((float)$this->amount, 2, '.', '');
    }
}