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
        font-size: 70px;
        font-weight:500;
        /* font-style: ; */
    }

    .attendance {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 40px;
    }

    .big {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 28px;
    }

    .small {
        font-family: NanumMyeongjo, sans-serif;
        font-size: 12px;
    }

    .signature {
        text-align:center;
        font-family: Zapfino, sans-serif;
        font-size: 16px;
    }

    .backdrop {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
    }

    .center {
        z-index: 1;
        margin-left: 58px;
        margin-top: 60px;
        width: 660px;
        height: 950px;
        text-align: center;
    }

    .bottom {
        position: absolute;
        bottom: 68px;
        z-index: 1;
        text-align: center;
    }


</style>

</head>
<body>
    @foreach ($bookings as $booking)
        <div>
{{--            <img class="backdrop" src="{{ asset('images/ManualCertA4.svg')--}}
            <img class="backdrop" src="{{'data:image/svg+xml;base64,'.base64_encode(file_get_contents(public_path('images/ManualCertA4.svg')))}}"/>
            <div class="center">
                <div class="cetrificate" style="margin-top: 126px;">
                    CERTIFICATE
                </div>
                <div class="attendance" style="margin-top: 13px;">
                    OF ATTENDANCE
                </div>
                <div class="small" style="margin-top: 45px;">
                    THIS IS TO CERTIFY THAT
                </div>
                <div class="big" style="margin-top: 40px;">
                    {{ strtoupper(($booking->name ?? 'no name given') . ' ' . ($booking->surname ?? 'no surname given'))   }}
                    {{-- MARIANO SANCHES DE MARIA GONZALEZ FERNANDEZ --}}
                </div>
                <div class="small" style="margin-top: 19px;">
                    HAS ATTENDED AND COMPLETED A {{strtoupper($booking->course->course_type->duration)}} COURSE
                </div>
                <div class="small" style="margin-top: 6px;">
                    IN
                </div>
                <div class="big" style="margin-top: 30px;">
                    {{ strtoupper($booking->course->course_type->name)}}
                </div>
                <div class="small" style="margin-top: 15px;">
                    ON
                </div>
                <div class="big" style="margin-top: 30px;">
                    {{ $booking->course->date->format('dS') . strtoupper($booking->course->date->format(' F ')) . $booking->course->date->format('Y') }}
                </div>
                <div class="small" style="margin-top: 15px;">
                    AT
                </div>
                <div class="big" style="margin-top: 30px;">
                    {{ strtoupper($booking->course->venue->name)}}
                </div>
                <div class="small" style="margin-top: 15px;">
                    EXPIRY ON: {{ strtoupper( Carbon\Carbon::parse($booking->course->date)->addYears($booking->course->course_type->valid_for_years)->format('F Y'))}}
                </div>


            </div>

            <div class="bottom">
                <div>
                    <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/cit_logo.png')))}}" width="120px"/>
                </div>

                <div style="margin-top:5px">
                    <table width="100%" style="z-index: 1;">
                        <tr style="border: 1px solid black">
                            <td style="width:3%;"></td>
                            <td style="width:20%;" class="signature">{{ $booking->course->tutor->name}}</td>
                            <td style="width:10%;"></td>
                            <td style="width:20%; text-align: center; vertical-align: bottom;">WWW.CITLTD.IE</td>
                            <td style="width:3%;"></td>
                        </tr>
                        <tr>
                            <td height="1px"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style=""></td>
                            <td style="text-align: center; vertical-align: top;">TUTOR: {{ strtoupper($booking->course->tutor->name)}}</td>
                            <td style=""></td>
                            <td style="text-align: center; vertical-align: top;">HANK@CITLTD.IE</td>
                            <td style=""></td>
                        </tr>
                    </table>
                </div>
            </div>

            @if (!$loop->last)
                <div style="page-break-after:always;"></div>
            @endif
        </div>
    @endforeach
</body>
</html>
