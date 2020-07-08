<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Course;
use App\Http\Requests\CreateBooking;
use Illuminate\Http\Request;

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
        $booking = Booking::firstOrNew($request->validated());

        dd($booking);


//        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentMethod = $request->input('stripePaymentMethod.id');
        $user = auth()->user();
        $user->addPaymentMethod($paymentMethod);

        try {
            $payment = $user->charge(100, $paymentMethod);
        } catch (Exception $e) {
            //
        }

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
