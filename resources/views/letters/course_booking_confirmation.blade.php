<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirmation</title>

<style type="text/css">

    * {
        font-family: Verdana, Arial, sans-serif;
        font-size: x-small;
    }

    table.table1 {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0px;
    }

    table.table1 td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 8px;
    }
    table.table2 {
        /* border: 1px solid black;
        border-collapse: collapse; */
        /* background-color: white; */
    }
    table.table2 td {
            /* border: 1px solid black;
            border-collapse: collapse;
            padding: 5px; */
            /* background-color: lightblue; */
    }
    table.table3 {
        /* border: 1px solid black;
        border-collapse: collapse; */
        /* background-color: white; */
    }
    table.table3 td {
            /* border: 1px solid black;
            border-collapse: collapse;
            padding: 5px; */
            background-color: lightblue;
    }




</style>

</head>
<body>
    @foreach ($bookings as $booking)

     {{-- multiple pages --}}
        <div style="margin: 20px;">
            <div>
                <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/cit_logo.png')))}}" width="180"/>
            </div>
            <div style="height: 40px; background-color: white; border-width:2px; border-bottom-style:solid;"></div>
            <div style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;"></div>
            <div style="padding: 3px; font-weight: bold; font-size: xx-small; background-color: white;">
                <div>CIT Ltd., Unit C3, Dunshaughlin Business Park, Dunshaughlin, Co Meath A85 YV58</div>
                <div>Tel : 01 809 7266	Fax:  01 809 7520	 e-mail: info@citltd.ie www.citltd.ie</div>
            </div>
            <div style="height: 30px; background-color: white;"></div>
            <div style="height: 40px; background-color: white; text-align: center; font-size: large;">COURSE BOOKING CONFIRMATION</div>
            <div style="height: 20px; background-color: white;"></div>

            <table class="table1" width="100%">
                <tbody>
{{--                    <tr>--}}
{{--                        <td>Candidate Name:</td>--}}
{{--                        <td>{{$booking->name .' '. $booking->surname}}</td>--}}
{{--                    </tr>--}}
{{--                    @if (!isset($booking->company))--}}
{{--                        <tr>--}}
{{--                            <td>Amount:</td>--}}
{{--                            <td>{{$booking->rate}} &euro;</td>--}}
{{--                        </tr>--}}
{{--                    @endif--}}
                    <tr>
                        <td width="20%">Course:</td>
                        <td>{{$booking->course->course_type->name}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Spaces:</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Course Date:</td>
                        <td>{{$booking->course->date->format('l jS F Y')}}</td>
                    </tr>
                    <tr>
                        <td>Start Time:</td>
                        <td>{{$booking->course->date->format('l jS F Y')}}</td>
                    </tr>
                    <tr>
                        <td>Finish Time:</td>
                        <td>{{$booking->course->date->format('l jS F Y')}}</td>
                    </tr>
                    <tr>
                        <td>Course Venue:</td>
                        <td>{{$booking->course->venue->name .' '. $booking->course->venue->fullAddress() }}</td>
                    </tr>
                    <tr>
                        <td>Map:</td>
                        <td><a href="{{ isset($notifiable->course->venue->google_maps) ? $notifiable->course->venue->google_maps : '' }}">{{ isset($notifiable->course->venue->google_maps) ? $notifiable->course->venue->google_maps : '' }}</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td>Cost:</td>
                        <td>&euro; {{$booking->course->price}} per person</td>
                    </tr>
                    <tr>
                        <td>Requirements:</td>
                        <td>All candidates must have an Irish PPS Number (if a candidiate does not have an Irish PPS number they must contact us at least three days in advance of the course date. Each candidate must bring proof of identification on the day of the course.</td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td>COVID-19:</td>--}}
{{--                        <td>All candidates must complete and return the form in this link no later than three days prior to the course date--}}
{{--                            <a href="https://form.jotform.com/220656520766054">https://form.jotform.com/220656520766054</a></td>--}}
{{--                    </tr>--}}
                    <tr>
                        <td colspan="2"><b>Any candidates that do not give 24 hours notice of non-attendance will be charged a €150 cancellation fee.</b></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Any candidates that arrive after the course start time may be refused entry and will be charged a €150 cancellation fee.</b></td>
                    </tr>

                </tbody>
            </table>
            <div style="margin-top: 20px;">
                Please Note:  This document will serve as evidence of booking {{$booking->course->course_type->name}} course on the above date.
                If further verification is needed, please contact C.I.T. Ltd. on the number above.</div>
            <div style="margin-top: 160px;"></div>

{{--            <table class="table2" style="padding: 15px; width: 100%; margin-bottom: 60px; ">--}}
{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <td style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;"></td>--}}
{{--                        <td style="width: 30%;"></td>--}}
{{--                        <td style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;">{{$booking->course->date->format('jS F Y')}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                    <td>{{$booking->course->tutor->name}}</td>--}}
{{--                        <td></td>--}}
{{--                        <td>Date</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>{{$booking->course->course_type->tutor_title}}</td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            <div style="margin-bottom: 20px;"></div>--}}
            <div style="margin-top: 20px; margin-left: 10%; margin-right: 10%;">
                <div style="margin: 10px; border: 1px solid black; padding: 10px">
                        Please see our website for all of our available upcoming Safe Pass courses.
                        www.citltd.ie Also you can contact the office for any queries you may have regarding training 018097266
                </div>
            </div>
        </div>
        <div style="page-break-after:always;">
    @endforeach

</body>
</html>
