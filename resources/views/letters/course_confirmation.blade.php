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
        <div style="margin: 50px;">
            <div><img src="{{public_path('images/cit_logo.png')}}" alt="" width="180"/></div>
            <div style="height: 40px; background-color: white; border-width:2px; border-bottom-style:solid;"></div>
            <div style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;"></div>
            <div style="padding: 3px; font-weight: bold; font-size: xx-small; background-color: white;">
                <div>CIT Ltd., Unit C3, Dunshaughlin Business Park, Dunshaughlin, Co Meath A85YV58</div>
                <div>Tel : 01 809 7266	Fax:  01 809 7520	 e-mail: info@citltd.ie www.citltd.ie</div>
            </div>
            <div style="height: 60px; background-color: white;"></div>
            <div style="height: 40px; background-color: white; text-align: center; font-size: large;">COURSE RECEIPT / VERIFICATION CERTIFICATE</div>
            <div style="height: 40px; background-color: white;"></div>

            <table class="table1" width="100%">
                <tbody>
                    <tr>
                        <td width="20%">Course:</td>
                        <td>{{$booking->course->course_type->name}}</td>
                    </tr>
                    <tr>
                        <td>Course Date:</td>
                        <td>{{$booking->course->date->format('l jS F Y')}}</td>
                    </tr>
                    <tr>
                        <td>Course Venue:</td>
                        <td>{{$booking->course->venue->name .' '. $booking->course->venue->fullAddress() }}</td>
                    </tr>
                    <tr>
                        <td>Candidate Name:</td>
                        <td>{{$booking->name .' '. $booking->surname}}</td>
                    </tr>
                    @if (!isset($booking->company))
                    <tr>
                        <td>Amount:</td>
                        <td>{{$booking->rate}} &euro;</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                Please Note:  This document will serve as evidence of having completed the {{$booking->course->course_type->name}} course on the above date until the candidate receives their {{$booking->course->course_type->name}} card.
                If further verification is needed, please contact C.I.T. Ltd. on the number above.</div>
            <div style="margin-top: 80px;"></div>

            <table class="table2" style="padding: 15px; width: 100%; margin-bottom: 60px; ">
                <tbody>
                    <tr>
                        <td style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;"></td>
                        <td style="width: 30%;"></td>
                        <td style="height: 2px; background-color: white; border-width:1px; border-bottom-style:solid;">{{$booking->course->date->format('jS F Y')}}</td>
                    </tr>
                    <tr>
                    <td>{{$booking->course->tutor->name}}</td>
                        <td></td>
                        <td>Date</td>
                    </tr>
                    <tr>
                        <td>{{$booking->course->course_type->tutor_title}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            {{-- <div style="margin-top: 10px;"></div> --}}
            <div style="margin-left: 10%; margin-right: 10%;">
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
