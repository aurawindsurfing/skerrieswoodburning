<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;

class TestController extends Controller
{
    public function test()
    {
    
        $b = Booking::find(85);

        dump($b->course->course_type->default_rate);

    }
}
