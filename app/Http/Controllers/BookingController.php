<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Course;
use App\Http\Requests\CreateBooking;
use App\Notifications\StudentConfirmation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Propaganistas\LaravelPhone\PhoneNumber;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

/**
 * Class BookingController
 *
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

        try {
            $booking = new Booking($data);

            $payment = ($booking)->charge(($course->price * 100), $stripePaymentMethodId, [
                'metadata' => $data,
            ]);

            $booking->stripe_payment_intent = $payment->id;
            $booking->save();

            Session::flash('success', 'Payment successful!');

            if (PhoneNumber::make($booking->phone, config('nexmo.countries'))->isOfType('mobile')) {
                $booking->notify(new StudentConfirmation($booking));
            }



        } catch (InvalidRequestException $e) {
            return back()->withInput()->with('card-error', 'Please fill in the form again. Do not refresh the form!');
        } catch (CardException $e) {
            return back()->withInput()->with('card-error', $e->getMessage());
        } catch (PaymentActionRequired $e) {
            return redirect()->route('cashier.payment', [$e->payment->id, 'redirect' => route('home')]);
        } catch (Exception $e) {
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
