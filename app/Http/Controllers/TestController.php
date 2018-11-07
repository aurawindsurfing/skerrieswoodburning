<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;

class TestController extends Controller
{
    public function test()
    {
    
        $b = Booking::find(73);

        // dd($b->isMissingInvoice());

        // dump('what the fuck');

    }
}
