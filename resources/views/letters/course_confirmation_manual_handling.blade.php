<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirmation</title>

<style type="text/css">

    @font-face {    font-family: NanumMyeongjo; 
                    src: url('{{ public_path("fonts/NanumMyeongjo-Bold.ttf")}}');
                    /* format("truetype"); */
                    /* font-weight: 500;  */
                    /* font-style: normal; */
                    
                 } 
    @font-face { font-family: Zapfino; 
                    src: url('{{ public_path("fonts/Zapfino.ttf")}}');
                    format("truetype");
                    font-weight: 400; 
                    font-style: normal;
                }

    /* html { margin: 0px}; */

    * {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 60px;
        color: #6394A3;
    }

    .backdrop {
        position: absolute;
        left: -5px;
        top: -45px;
        width: 100%;
        /* height: 200%; */
    }

    .center {
        z-index: 1; 
        margin-left: 49px;
        margin-top: 10px;
        width: 612px; 
        border: 2px solid red;
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
            <img class="backdrop" src="{{ public_path('images/ManualCertA4.svg') }}">
            <div class="center">
                <div style="height: 860px">
                    THOMAS LOTOCKI
                </div>
            </div>
            <div style="page-break-after:always;">
        </div>      
    @endforeach
</body>
</html>