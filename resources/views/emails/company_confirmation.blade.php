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
        {{ isset($bookings->first->company->contact->name) ? $bookings->first->company->contact->name . ', thank you for your booking, details of which are below. ' : 'Thank you for your booking, details of which are below. '}}<br><br>
        Please complete and submit this Covid-19 form today<br><br>
        <a href="https://form.jotform.com/201684563050350">https://form.jotform.com/201684563050350</a><br><br>
        BOOKING DETAILS:<br><br>
    </div>

    @foreach ($bookings as $booking)

        <div class="container ml-6 max-w-sm">
            Candidate: {{ ($booking->name ?? '')  .' '. ($booking->surname ?? '') }}<br>
            Course: {{ $booking->course->course_type->name }}<br>
            Date: {{ $booking->course->date->format('d-m-Y') }}<br>
            Time: {{ date('H:i', strtotime($booking->course->time)) }}<br>
            Venue: {{ $booking->course->venue->name }} <br>
            Venue address: {{ $booking->course->venue->address_line_1.', '.$booking->course->venue->city.', '.$booking->course->venue->postal_code }} <br>
            <br>
            Payment received: &euro; {{$booking->course->price}} <br>
            <br>
            <b>{{ isset($booking->course->venue->google_maps) ? 'Directions: ' : ''}}</b><a href="{{ isset($booking->course->venue->google_maps) ? $booking->course->venue->google_maps : '' }}">{{ isset($booking->course->venue->google_maps) ? $booking->course->venue->google_maps : '' }}</a><br>
            <br>
            <b>All candidates must bring proof of a valid Irish PPS number and Photographic ID.</b><br>
            <b>If you do not have an Irish PPS Number we will be in touch with you in advance of the course.</b><br>
            <br>
            <i>Any cancellations within 24 hours of the course start time will incur a cancellation fee of 70% of the course fee. Any candidate who does not show up on the day will not receive a refund. Any candidate who arrives after the Course Start Time may be refused entry and will not receive a refund.</i><br>
            <br>
            <br>
        </div>

    @endforeach

    @component('emails.partials.footer')
        <div class="font-bold">{{ isset($booking->user->name) ? $booking->user->name : 'Hank Traynor' }}</div>
    @endcomponent

</body>
</html>



