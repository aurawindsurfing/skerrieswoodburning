<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Illuminate\Support\Facades\Storage;
use App\Course;
use Illuminate\Support\Facades\Mail;



class TestController extends Controller
{
    public function test()
    {
       $e = session('booking');

       dd($e);

    }


    public function test2()
    {
        
        Mail::to('admin@foo.bar')->send(new \App\Mail\SomeMailClass($data));

    }
}