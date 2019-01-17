<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"> {{--
    <title>{{ $invoice->name }}</title> --}}
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        div {
            font-family: DejaVu Sans;
            font-size: 10px;
            font-weight: normal;
        }

        th {
            font-family: DejaVu Sans;
            font-size: 10px;
            font-weight: bold;
        }

        td {
            font-family: DejaVu Sans;
            font-size: 10px;
            font-weight: normal;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-default {
            border-color: #ddd;
        }

        .panel-body {
            padding: 15px;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0px;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;

        }

        thead {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }

        th {
            border: 1px solid #ddd;
            padding: 6px;
        }

        td {
            /* border: 1px solid #ddd; */
            padding: 6px;
        }

        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body>
    @foreach ($credit_notes as $credit_note)
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:250pt;">
            <img src="{{asset(config('invoice_details.logo'))}}" alt="" width="{{ config('invoice_details.logo_width') }}" />
        </div>
        <div style="margin-left:300pt;">
            <b>Credit Note #: </b> {{ $credit_note->number() }}<br />
            <b>Credit Date: </b> {{ $credit_note->created_at->formatLocalized('%A %d %B %Y') }}<br />
        </div>
    </div>
    <br />
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:250pt;">
            <h4>Business Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ config('invoice_details.business_details.name') }}<br /> ID: {{ config('invoice_details.business_details.id')
                    }}<br /> {{ config('invoice_details.business_details.phone') }}<br /> {{ config('invoice_details.business_details.location')
                    }}<br /> {{ config('invoice_details.business_details.zip') }} {{ config('invoice_details.business_details.city')
                    }} {{ config('invoice_details.business_details.country') }}<br />
                </div>
            </div>
        </div>
        <div style="margin-left: 300pt;">
            <h4>Customer Details:</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $credit_note->invoice->company->name ?? $invoice->bookings->first()->name .' '.$invoice->bookings->first()->surname }}<br/>
                    ID: {{ $credit_note->invoice->company->tax ?? '' }}<br/>
                    {{ $credit_note->invoice->company->phone ?? $invoice->bookings->first()->phone}}<br/>
                    {{ $credit_note->invoice->company->address ?? '' }}<br/>
                </div>
            </div>
        </div>
    </div>
    <h5 style="margin-top: 0px;">Items:</h5>
    <table>
        <thead>
            <tr bgcolor="black">
                <th style="width:5%;"><font color="white">#</font></th>
                <th style="border-right: none;"><font color="white">Item Name</font></th>
                <th style="width:20%; border-left: none;"></th>
                <th style="width:20%;"><font color="white">Amount</font></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border-bottom: 1px solid #ddd;">1</td>
                <td style="border-bottom: 1px solid #ddd;">Credit applied to invoice number: {{ $credit_note->invoice->number() }}</td>
                <td style="border-bottom: 1px solid #ddd;"></td>
                <td style="border-bottom: 1px solid #ddd;">&euro;{{ $credit_note->totalForInvoice() }}</td>
            </tr>
            <tr border="0">
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><b>&euro;{{ $credit_note->totalForInvoice() }}</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Credits Used</td>
                <td><font color="red">{{ '(-) ' . $credit_note->totalForInvoice() }}</font></td>
            </tr>     
            <tr>
                <td></td>
                <td></td>
                <td style="background-color: #f5f5f5;"><b>Credits Remaining</b></td>
                <td style="background-color: #f5f5f5;"><b>&euro; 0.00</b></td>
            </tr>



        </tbody>
    </table>


    @if (!$loop->last)
    <div style="page-break-after:always;"></div>
    @endif @endforeach
</body>

</html>