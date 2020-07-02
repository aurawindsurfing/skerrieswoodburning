<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Course;
use App\Http\Requests\CreateBooking;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

/**
 * Class BookingController
 * @package App\Http\Controllers
 */
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('registration', compact('course'));
    }

    /**
     * @param CreateBooking $request
     */
    public function store(CreateBooking $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => request('stripeToken'),
            "description" => "Test payment from sqwsqw"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
