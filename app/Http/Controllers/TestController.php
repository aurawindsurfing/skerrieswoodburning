<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\BookingConfirmationSms;


class TestController extends Controller
{
    public function test()
    {
        
        $uninvoiced_bookings = Booking::take(5)->get();


        if ($uninvoiced_bookings->isNotEmpty()) {

            $invoiceController = new \App\Http\Controllers\InvoiceController();
            $count = 0;

            // grouping bookings by company and separating individual booking
           $company_bookings = $uninvoiced_bookings->groupBy('company_id');
           $individual_bookings = $company_bookings->pull('');


           if (!is_null($company_bookings) && $company_bookings->isNotEmpty()) {
            
                foreach($company_bookings as $company_booking){

                    $invoice = $invoiceController->create($company_booking);
                    $invoiceController->makePDF($invoice);
                    $count++;

                }

           }

           if (!is_null($individual_bookings) && $individual_bookings->isNotEmpty()) {

                foreach($individual_bookings as $individual_booking){

                    $invoice = $invoiceController->create($individual_booking);
                    $invoiceController->makePDF($invoice);
                    $count++;

                }
           }
        }
    }
}
