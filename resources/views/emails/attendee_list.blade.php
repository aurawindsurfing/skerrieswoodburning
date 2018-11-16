<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendee List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
        
    @include('emails.partials.header')

    <div class="container ml-6 mt-12 max-w-sm">

        Please find attached attendee list for: <br>
        <br>
        Date: {{$data['course']->date->format('Y-m-d')}} <br>
        Course: {{$data['course']->course_type->name}} <br>
        Tutor: {{$data['course']->tutor->name}} <br>
        Venue: {{$data['course']->venue->name}} <br>
        <br>
        <br>

    </div>

    @component('emails.partials.footer')
        <div class="font-bold">   </div> 
    @endcomponent
    
</body>
</html>



