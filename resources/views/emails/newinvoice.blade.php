<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
        
    @include('emails.partials.header')

    <div class="container ml-6 mt-12 max-w-sm">

        Please find attached your recent invoice.

        <br>
        <br>

    </div>

    @component('emails.partials.footer')
        <div class="font-bold">{{$invoice->user->name}}</div> 
    @endcomponent
    
</body>
</html>



