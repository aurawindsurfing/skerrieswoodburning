<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
        
    @include('emails.partials.header')

    <div class="container ml-6 max-w-m">
        {{ isset($bookings->first->company->contact->name) ? $bookings->first->company->contact->name . ', thank you for your bookings. ' : 'Thank you for your bookings. '}}<br><br>
        <b>{{ strtoupper($bookings->first()->course->course_type->name) }} COURSE VENUE HAS CHANGED!!!</b><br><br>
        <b>DATE: {{ $bookings->first()->course->date->format('Y-m-d H:m') }}<br><br></b>

        FOLLOWING EMPLOYEES / CONTRACTORS NEED TO BE INFORMED ABOUT CHANGE OF VENUE:<br><br>
        
        @foreach ($bookings as $booking)
            Candidate: {{ (!isset($booking->name) ?: $booking->name)  .' '. (!isset($booking->surname) ?: $booking->surname) }}<br>
            Phone: {{ !isset($booking->phone) ?: $booking->phone }}<br><br>
        @endforeach

        <br><br>

        NEW VENUE DETAILS ARE AS FOLLOWS:<br><br>
        
        {{ (isset($bookings->first()->course->venue->name)) ? 'Venue: ' . $bookings->first()->course->venue->name : '' }}<br>
        {{ (isset($bookings->first()->course->venue->address_line_1)) ? 'Address: ' . $bookings->first()->course->venue->address_line_1 : '' }}<br>
        {{ (isset($bookings->first()->course->venue->city)) ? 'City: ' . $bookings->first()->course->venue->city : '' }}<br>
        {{ (isset($bookings->first()->course->venue->postal_code)) ? 'Postal Code: ' . $bookings->first()->course->venue->postal_code : '' }}<br>
        {{ (isset($bookings->first()->course->venue->phone)) ? 'Phone: ' . $bookings->first()->course->venue->phone : '' }}<br><br>
        {{ (isset($bookings->first()->course->venue->directions)) ? 'Directions: ' . $bookings->first()->course->venue->directions : '' }}<br><br>
        {{ (isset($bookings->first()->course->venue->google_maps)) ? 'Google Maps: ' : '' }} <a href="{{ (isset($bookings->first()->course->venue->google_maps)) ? $bookings->first()->course->venue->google_maps : '' }}">{{ (isset($bookings->first()->course->venue->google_maps)) ? $bookings->first()->course->venue->google_maps : '' }}</a><br><br>

    </div>

    <div class="container ml-6 max-w-m">
        <br>
        We are sorry for any inconvenience caused.<br>
        <br>
    </div>

    @component('emails.partials.footer')
        <div class="font-bold">{{ isset($bookings->first()->user->name) ? $bookings->first()->user->name : '' }}</div> 
    @endcomponent
    
</body>
</html>