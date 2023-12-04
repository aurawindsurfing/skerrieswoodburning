<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New website enquiry </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    @include('emails.partials.header')

    <div class="container ml-6 mt-12 max-w-sm">

        New website enquiry was just made on the website.<br>
        <br>
        Name: {{$data['name']}}<br>
        Phone: {{'+'.$data['phone'] ?? ''}}<br>
        Email: {{$data['email'] ?? ''}}<br>
        Company: {{$data['company'] ?? ''}}<br>
        <br>
        Course type: {{$data['type'] ?? ' --missing course type--.'}}<br>
        <br>
        Enquiry: {{ $data['enquiry'] ?? '--missing message--'}}<br>

    </div>

{{--    @component('emails.partials.footer')--}}
{{--        <div class="font-bold">   </div>--}}
{{--    @endcomponent--}}

</body>
</html>



