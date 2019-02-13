<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course Cancellation Notice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
        
    @include('emails.partials.header')

    <div class="container ml-6 max-w-m">
        {{ isset($bookings->first->company->contact->name) ? $bookings->first->company->contact->name . ', thank you for your bookings. ' : 'Thank you for your bookings. '}}<br><br>
        <b>{{ strtoupper($bookings->first()->course->course_type->name) }} COURSE HAS BEEN CANCELLED!!!</b><br><br>
        
        <b>DATE:</b>    {{ $bookings->first()->course->date->format('Y-m-d') }}<br><br>
        <b>TIME:</b>    {{ date('H:i', strtotime($bookings->first()->course->time)) }}<br><br>
        <b>VENUE:</b>   {{ $bookings->first()->course->venue->name }}<br><br>
        <b>ADDRESS:</b> {{ $bookings->first()->course->venue->address_line_1 }}<br><br>
        <b>CITY:</b>    {{ $bookings->first()->course->venue->city }}<br><br>

        FOLLOWING EMPLOYEES / CONTRACTORS NEED TO BE INFORMED ABOUT THE COURSE CANCELLATION:<br><br>
        
        @foreach ($bookings as $booking)
            Candidate: {{ (!isset($booking->name) ?: $booking->name)  .' '. (!isset($booking->surname) ?: $booking->surname) }}<br>
            Phone: {{ !isset($booking->phone) ?: $booking->phone }}<br><br>
        @endforeach

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