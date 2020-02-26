<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = [];

    protected static $logUnguarded = true;

    public function bookings()
    {
        return $this->hasMany(\App\Booking::class);
    }

    public function contacts()
    {
        return $this->hasMany(\App\Contact::class);
    }

    public function accounts_payable()
    {
        return $this->hasMany(\App\Contact::class);
    }

    public function invoices()
    {
        return $this->hasMany(\App\Invoice::class);
    }

    public function unpaid_invoices()
    {
        return $this->hasMany(\App\Invoice::class)->where('status', 'unpaid');
    }
}
