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
        // $data = [
        //     'bookings' => Booking::take(10)->get(),
        // ];

        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadView('letters.course_confirmation', $data);
        // $id = uniqid();
        // $pdf->save('storage/tmp/confirmations/confirmation_letter_'. $id .'.pdf');

        // return view('letters.course_confirmation');
        
        
        // $e = public_path(Storage::url('test.php'));

        // dd($e);

        $b = Course::find(11);

        $b = $b->bookings()->get();

        dd($b); 

    }
}