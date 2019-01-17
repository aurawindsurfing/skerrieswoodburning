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
            font-weight:light;
            font-size: 14px;
        }

        td {
            /* border: 1px solid #ddd; */
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
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
    @foreach ($receipts as $receipt)

    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0%; top:35pt width:250pt;">
            <img src="{{asset(config('invoice_details.logo'))}}" alt="" width="{{ config('invoice_details.logo_width') }}" />
        </div>

        <div style="position:absolute; left:25%; top:15pt; width:250pt; font-size: 20px;">
            <div>
                <font size="2">
                <b>{{ config('invoice_details.business_details.name') }}</b><br />
                ID: {{ config('invoice_details.business_details.id')}}<br />
                {{ config('invoice_details.business_details.phone') }}<br />
                {{ config('invoice_details.business_details.location')}}<br />
                {{ config('invoice_details.business_details.zip') }} {{ config('invoice_details.business_details.city')}} {{ config('invoice_details.business_details.country') }}<br />
                </font>
            </div>
        </div>
        <div style="position:absolute; left:0%; top:130pt width:250pt;">
            <table>
                <thead>
                    <hr style="border-top: 1px;">
                </thead>
            </table>
        </div>
        <div style="position:absolute; left:0%; top:140pt width:250pt;"><center><font size="4">PAYMENT RECEIPT</font></center></div>

        <div style="position:absolute; left:0%; top:200pt width:250pt;">
            <div>
                <table>
                        <tbody>
                            <tr>
                                <td><font size="2">Payment Date</font></td>
                                <td style="border-bottom: 1px solid #ddd;"><b><font size="2">{{ $receipt->created_at->formatLocalized('%d %B %Y') }}</font></b></td>
                                <td style="width:5%;"></td>
                                <td rowspan="4" style="width: 25%;" bgcolor="grey">
                                    <center>
                                    <font size="3"><font color="white">
                                        Amount Received<br/><font size="5">&euro;{{ $receipt->amountForReceipt() }}</font>
                                    </font>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td><font size="2">Receipt Id</font></td>
                                <td style="border-bottom: 1px solid #ddd;"><b><font size="2">{{ $receipt->number() }}</font></b></td>
                            </tr>
                            <tr>
                                <td><font size="2">Reference Number</font></td>
                                <td style="border-bottom: 1px solid #ddd;"><b><font size="2">{{ $receipt->reference ?? '-' }}</font></b></td>
                            </tr>
                            <tr>
                                <td><font size="2">Payment Method</font></td>
                                <td style="border-bottom: 1px solid #ddd;"><b><font size="2">{{ $receipt->payment_method }}</font></b></td>
                            </tr>
                        </tbody>
                    </table>                    
            </div>
        </div>


        {{-- @if (!isset($receipt->invoice->company)) --}}
            <div style="position:absolute; left:0%; top:55%; width:250pt; font-size: 20px;">
                <div>
                    <font size="2">
                        Bill to<br><br>
                        {{ $receipt->invoice->company->name ?? $invoice->bookings->first()->name .' '.$invoice->bookings->first()->surname }}<br/>
                        ID: {{ $receipt->invoice->company->tax ?? '' }}<br/>
                        Phone: {{ $receipt->invoice->company->phone ?? $invoice->bookings->first()->phone}}<br/>
                        {{ $receipt->invoice->company->address ?? '' }}<br/>
                    </font>
                </div>
            </div>
        {{-- @endif --}}
       


        <div style="position:absolute; left:0%; top:550pt width:250pt;">
            <table>
                <thead>
                    <hr style="border-top: 1px;">
                </thead>
            </table>
            <br><br>
            <font size="3"><b>Payment For</b></font><br><br>
                <table style="width: 100%;">
                    <thead>
                        <tr bgcolor="lightgrey">
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Invoice Amount</th>
                            <th>Invoice Balance Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $receipt->invoice->number() }}</td>
                            <td>{{ $receipt->invoice->date->formatLocalized('%d %B %Y') }}</td>
                            <td>&euro;{{ $receipt->invoice->totalForInvoice() }}</td>
                            <td>&euro;{{ $receipt->invoice->balanceDueForInvoice() }}</td>
                        </tr>
                    </tbody>
                </table>
        </div>

        <div style="position:absolute; left:0%; top:570pt; width:250pt; font-size: 20px;">
            <div>
                
            </div>
        </div>

    </div>

    @if (!$loop->last)
        <div style="page-break-after:always;"></div>
    @endif @endforeach
</body>

</html>