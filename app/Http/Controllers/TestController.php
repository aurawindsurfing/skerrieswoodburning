<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Illuminate\Support\Facades\Storage;
use App\Course;



class TestController extends Controller
{
    public function test()
    {
       $e = session('booking');

       dd($e);

    }
}