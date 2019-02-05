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

    <div class="container ml-6 max-w-sm">
        {{ isset($bookings->first->company->contact->name) ? $bookings->first->company->contact->name . ', thank you for your booking. ' : 'Thank you for your booking. '}}<br><br>
        BOOKING DETAILS:<br><br>
    </div>

    @foreach ($bookings as $booking)

        <div class="container ml-6 max-w-sm">
            Candidate: {{ ($booking->name ?? '')  .' '. ($booking->surname ?? '') }}<br>
            Course: {{ $booking->course->course_type->name }}<br>
            Date: {{ $booking->course->date->format('Y-m-d H:m') }}<br>
            Venue: {{ $booking->course->venue->name }} <br><br>
        </div>

    @endforeach

    <div class="container ml-6 max-w-sm">
        <br>
            We will text you exact directions one day before the course.<br>
        <br>
    </div>

    @component('emails.partials.footer')
        <div class="font-bold">{{ $booking->user->name }}</div> 
    @endcomponent
    
</body>
</html>



