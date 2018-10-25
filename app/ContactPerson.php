<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    public function company()
    {
        return $this->hasOne('App\Company');
    }
}
