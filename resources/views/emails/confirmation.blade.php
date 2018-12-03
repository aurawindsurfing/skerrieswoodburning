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

    <div class="container ml-6 mt-12 max-w-sm">

        {{ isset($notifiable->name) ? $notifiable->name . ', thank you for your booking: ' : 'Thank you for your booking: '}}<br><br>
        Course Type: {{ $notifiable->course->course_type->name }} <br>
        Venue: {{ $notifiable->course->venue->name }} <br>
        Date: {{ $notifiable->course->date->format('Y-m-d H:m') }} <br><br>
        We will text you exact directions one day before the course.<br>
        Kind Regards<br>
        <br>

    </div>

    @component('emails.partials.footer')
        <div class="font-bold">   </div> 
    @endcomponent
    
</body>
</html>



