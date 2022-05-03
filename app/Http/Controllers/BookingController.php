<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Course;
use App\Http\Requests\CreateBooking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

/**
 * Class BookingController
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Course $course)
    {
        if ($course->placesLeft() < 0) {
            return redirect()->route('home')->with('overbooked', 'We are sorry but this course is fully booked!');
        }

        // this comes from laravel cashier after SCA second authorization
        if (\request()->query('success') == true) {
            Session::flash('success', 'Payment successful!');
        }

        return view('registration', compact('course'));
    }

    /**
     * @param CreateBooking $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBooking $request)
    {
        $course = Course::find($request->input('courseId'));

        $stripePaymentMethodId = $request->input('stripePaymentMethodId');

        $data = array_merge($request->validated(), [
            'date'         => now(),
            'rate'         => $course->price,
            'course_id'    => $course->id,
            'payment_type' => 'cc',
        ]);

        $booking = new Booking($data);
        $booking->stripe_status = 'incomplete';
        $booking->save();

        $data = array_merge($data, ['booking_id' => $booking->id]);

        try {
            $payment = ($booking)->charge(($course->price * 100), $stripePaymentMethodId, [
                'metadata' => $data,
            ]);

            $booking->stripe_payment_intent = $payment->id;
            $booking->stripe_status = 'succeeded';
            $booking->save();

            Session::flash('success', 'Payment successful!');
        } catch (InvalidRequestException $e) {
            return back()->withInput()->with('card-error', 'Please fill in the form again. Do not refresh the page!');
        } catch (CardException $e) {
            $booking->stripe_payment_intent = $e->getError()->payment_intent->id;
            $booking->stripe_status = 'failed';
            $booking->save();

            return back()->withInput()->with('card-error', $e->getMessage());
        } catch (PaymentActionRequired $e) {

            // fills in the form again for visual reference
            $request->flash();

            $booking->stripe_payment_intent = $e->payment->id;
            $booking->save();

            return redirect()->route('cashier.payment', [
                $e->payment->id,
                'redirect' => route('create-booking', ['course' => $course->slug]),
            ]);
        } catch (Exception $e) {
            $booking->stripe_status = 'failed';
            $booking->save();

            return back()->withInput()->with('card-error', $e->getMessage());
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
