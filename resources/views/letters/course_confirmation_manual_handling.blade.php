<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirmation</title>

<style type="text/css">

    * {
        font-family: Verdana, Arial, sans-serif;
        font-size: medium;
    }

    .backdrop {
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: -1;
    }

    /* body {
          background-image:url("{{ asset('images/A4@1x.png') }}");
          background-repeat:no-repeat;
          background-position:left top;
          background-size: 595px 842px;
       } */
    
</style>

</head>
<body>
    @foreach ($bookings as $booking)  
    <div> 
        <img class="backdrop" src="{{ asset('images/A4@1x.png') }}" width="103%">
        <div style="border: 6px solid blue; z-index: 1; margin-left: 83px; margin-top: 90px; width: 100%;">
            z-index: 1, order: 3
        </div>
        <div style="page-break-after:always;">
    </div>      
        
    @endforeach

</body>
</html>