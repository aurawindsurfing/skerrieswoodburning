<?php

namespace App;

use App\Http\Traits\UpdatesInvoiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class CreditNote extends Model
{
    use SoftDeletes;
    use LogsActivity;
    use UpdatesInvoiceStatus;

    protected $guarded = [];

    protected static $logUnguarded = true;

    protected $dates = [
        'date',
    ];

    public function invoice()
    {
        return $this->belongsTo(\App\Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function number()
    {
        return $this->prefix.$this->id;
    }

    public function totalForInvoice()
    {
        return number_format((float) $this->amount, 2, '.', '');
    }
}
