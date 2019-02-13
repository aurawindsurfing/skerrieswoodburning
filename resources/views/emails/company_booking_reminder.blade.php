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

    <div class="container ml-6">
        {{ isset($bookings->first->company->contact->name) ? $bookings->first->company->contact->name . ', this is a booking reminder for: ' : 'This is a booking reminder for: '}}<br><br>
        
    </div>

    @foreach ($bookings as $booking)

        <div class="container ml-6">
            Candidate: <b><span class="text-xl">{{ ($booking->name ?? '') . ' ' . ($booking->surname ?? '') }}</span></b><br>
            Course: <b><span class="text-xl">{{ $booking->upcoming_course_dates()->first()->course->course_type->name }}</span></b><br>
            Date: {{ $booking->upcoming_course_dates()->first()->course->date->format('Y-m-d') }}<br>
            Time: {{ $booking->upcoming_course_dates()->first()->course->date->format('H:m') }}<br><br>
            <b>Venue: </b> {{ $booking->upcoming_course_dates()->first()->course->venue->name }} <br>
            <b>Address: </b>{{ (isset($booking->upcoming_course_dates()->first()->course->venue->address_line_1) ? $booking->upcoming_course_dates()->first()->course->venue->address_line_1 : '') .
            (isset($booking->upcoming_course_dates()->first()->course->venue->city) ? ', ' . $booking->upcoming_course_dates()->first()->course->venue->city : '') .
            (isset($booking->upcoming_course_dates()->first()->course->venue->postal_code) ? ', ' . $booking->upcoming_course_dates()->first()->course->venue->postal_code : '') }} <br>
            <b>{{ isset($booking->upcoming_course_dates()->first()->course->venue->phone) ? 'Venue contact number: ' : ''}}</b>{{ isset($booking->upcoming_course_dates()->first()->course->venue->phone) ? $booking->upcoming_course_dates()->first()->course->venue->phone : '' }} <br>
            <b>{{ isset($booking->upcoming_course_dates()->first()->course->venue->google_maps) ? 'Google maps: ' : ''}}</b><a href="{{ isset($booking->upcoming_course_dates()->first()->course->venue->google_maps) ? $booking->upcoming_course_dates()->first()->course->venue->google_maps : '' }}">{{ isset($booking->upcoming_course_dates()->first()->course->venue->google_maps) ? $booking->upcoming_course_dates()->first()->course->venue->google_maps : '' }}</a><br><br><br>
        </div>

    @if ($booking->upcoming_course_dates()->count() > 1)

    <div class="container ml-6">
        <b>This is a multiday course, here are following dates and venues for the same:</b> <br><br>    
    </div>

    @foreach ($booking->upcoming_course_dates() as $additional_date)
        @if ($loop->first)
            @continue
        @endif

        <div class="container ml-6">
            <b>Date: </b>{{ $additional_date->date->format('Y-m-d') }}<br>
            <b>Time: </b>{{ $additional_date->date->format('H:m') }}<br>
            <b>Venue: </b> {{ $additional_date->venue->name }} <br>
            <b>Address: </b>{{ (isset($additional_date->venue->address_line_1) ? $additional_date->venue->address_line_1 : '') .
            (isset($additional_date->venue->city) ? ', ' . $additional_date->venue->city : '') .
            (isset($additional_date->venue->postal_code) ? ', ' . $additional_date->venue->postal_code : '') }} <br>
            <b>{{ isset($additional_date->venue->phone) ? 'Venue contact number: ' : ''}}</b>{{ isset($additional_date->venue->phone) ? $additional_date->venue->phone : '' }} <br>
            <b>{{ isset($additional_date->venue->google_maps) ? 'Google maps: ' : ''}}</b><a href="{{ isset($additional_date->venue->google_maps) ? $additional_date->venue->google_maps : '' }}">{{ isset($additional_date->venue->google_maps) ? $additional_date->venue->google_maps : '' }}</a><br><br><br>
        </div>


    @endforeach
    


    @endif

    @endforeach

    @component('emails.partials.footer')
        <b>{{ $booking->user->name }}</b> 
    @endcomponent
    
</body>
</html>



