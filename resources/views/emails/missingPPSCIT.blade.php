<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Missing PPS for </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    @include('emails.partials.header')

    <div class="container ml-6 mt-12 max-w-sm">

        Missing PPS number for: {{ isset($booking->name) ? $booking->name : '--missing name-- '}} {{ isset($booking->surname) ? $booking->surname : '--missing surname-- '}}<br>
        Phonenumber: {{ isset($booking->phone) ? $booking->phone : '--missing phone-- '}}
        COURSE DETAILS:<br>
        Course Type: {{ $booking->course->course_type->name }} <br>
        Venue: {{ $booking->course->venue->name }} <br>
        Date: {{ $booking->course->date->format('Y-m-d') }} <br>
        Time: {{ date('H:i', strtotime($booking->course->time)) }} <br><br>


    </div>

    @component('emails.partials.footer')
        <div class="font-bold">   </div>
    @endcomponent

</body>
</html>



