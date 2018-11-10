<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Nexmo\Laravel\Facade\Nexmo;


class TestController extends Controller
{
    public function test()
    {

        Nexmo::message()->send([
            'to'   => '353862194744',
            'from' => 'medlab',
            'text' => 'test',
        ]);

    }
}
