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

    @page {
        size: 21cm 29.7cm;
        margin: 5;
    }

    * {
        color: #6394A3;
    }

    .cetrificate {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 60px;
    }

    .attendance {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 35px;
    }

    .big {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 24px;
    }

    .small {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 10px;
    }

    .signature {
        text-align:center;
        font-family: Zapfino, sans-serif;
        font-size: 14px;
    }

    .backdrop {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        /* height: 95%; */
    }

    .center {
        z-index: 1; 
        margin-left: 58px;
        margin-top: 60px;
        width: 660px;
        height: 950px;
        /* border:transparent; */
        text-align: center;
    }

    div.demo {
        margin-left: 20px;
        margin-top: 45px;
        display: table;
        width: 90%;
        table-layout: fixed;    /* For cells of equal size */
    }
    div.demo span {
        display: table-cell;
        text-align: center;
        vertical-align: bottom;
    }

    
</style>

</head>
<body>
    @foreach ($bookings as $booking)  
        <div> 
            <img class="backdrop" src="{{ public_path('images/ManualCertA4.svg') }}">
            <div class="center">
                <div class="cetrificate" style="margin-top: 126px;">
                    CERTIFICATE
                </div>
                <div class="attendance" style="margin-top: 13px;">
                    OF ATTENDANCE
                </div>
                <div class="small" style="margin-top: 70px;">
                    THIS IS TO CERTIFY THAT
                </div>
                <div class="big" style="margin-top: 40px;">
                    THOMAS DAVID LOTOCKI
                </div>
                <div class="small" style="margin-top: 19px;">
                    HAS ATTENDED AND COMPLETED A HALF DAY COURSE
                </div>
                <div class="small" style="margin-top: 6px;">
                    ON
                </div>
                <div class="big" style="margin-top: 30px;">
                    MANUAL HANDLING
                </div>
                <div class="small" style="margin-top: 15px;">
                    ON
                </div>
                <div class="big" style="margin-top: 30px;">
                    27th OCTOBER 2019
                </div>
                <div class="small" style="margin-top: 15px;">
                    AT
                </div>
                <div class="big" style="margin-top: 30px;">
                    DUBLIN PORT
                </div>
                <div class="small" style="margin-top: 15px;">
                    EXPIRY ON: OCTOBER 2019
                </div>
                <div style="margin-top: 60px;">
                    <img src="{{ public_path('images/cit_logo.png') }}" alt="" width="120px" />
                </div>
                {{-- <div style="margin-top: 55px; margin-left:0px; text-align:center; border:1px solid red;">
                    <span class="signature" style="border:1px solid blue;">
                        Paul Hickey
                    </span>
                    <span class="small" style="margin-left:300px; border:1px solid blue;">
                        WWW.CITLTD.IE
                    </span>
                </div>

                
                <div style="margin-top: -2px; margin-left:5px; text-align:center; border:1px solid red;">
                    <span class="small" style="border:1px solid blue;">
                        TUTOR: PAUL HICKEY
                    </span>
                    <span class="small" style="margin-left:295px; border:1px solid blue;">
                        HANK@CITLTD.IEdewdewdwwe
                    </span>
                </div> --}}


                {{-- <div class="demo" style="border:1px solid red;">
                    <span class="signature" style="border:1px solid blue;">
                        Paul Hickey
                    </span>
                    <span></span>
                    <span class="small" style="border:1px solid blue; ;">
                        SOME SUPER LONG TEXT
                    </span>
                </div> --}}

                
                {{-- <div style="margin-top: -2px; margin-left:5px; text-align:center; border:1px solid red;">
                    <span class="small" style="border:1px solid blue;">
                        TUTOR: PAUL HICKEY
                    </span>
                    <span class="small" style="margin-left:295px; border:1px solid blue;">
                        HANK@CITLTD.IEdewdewdwwe
                    </span>
                </div> --}}

                <div style="margin-top:44px">
                    <table width="100%">
                        <tr bgcolor="" style="border: 1px solid black">
                            <td style="width:3%;"></td>
                            <td style="width:20%;" class="signature">Paul Hickey</td>
                            <td style="width:20%;"></td>
                            <td style="width:20%; text-align: center; vertical-align: bottom;">WWW.CITLTD.IE</td>
                            <td style="width:3%;"></td>
                        </tr>
                        <tr bgcolor="">
                            <td height="1px"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr bgcolor="">
                            <td style=""></td>
                            <td style="text-align: center; vertical-align: top;">TUTOR: PAUL HICKEY</td>
                            <td style=""></td>
                            <td style="text-align: center; vertical-align: top;">HANK@CITLTD.IE</td>
                            <td style=""></td>
                        </tr>
                    </table>
                </div>


            </div>
            <div style="page-break-after:always;">
        </div>      
    @endforeach
</body>
</html>