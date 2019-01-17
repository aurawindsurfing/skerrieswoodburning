<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Http\Traits\UpdatesInvoiceStatus;

class Payment extends Model
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

    public function number()
    {
        return 'R/' . $this->id . $this->created_at->format('Ymd');
    }
    
    public function amountForReceipt()
    {
        return number_format((float)$this->amount, 2, '.', '');
    }

}
