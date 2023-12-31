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
    @foreach ($invoices as $invoice)
    <div style="clear:both; position:relative;">
        <div style="position:absolute; left:0pt; width:250pt;">
            <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/cit_logo.png')))}}" width="120px"/>
{{--            <img src="{{asset(config('invoice_details.logo'))}}" alt="" width="{{ config('invoice_details.logo_width') }}" />--}}
        </div>
        <div style="margin-left:300pt;">
            <b>Invoice #: </b> {{ $invoice->number() }}<br />
            <b>Date: </b> {{ $invoice->date->formatLocalized('%A %d %B %Y') }}<br />
            <b>Due Date: </b> {{

            isset($invoice->company->payment_terms) ?
            Carbon\Carbon::now()->addDays($invoice->company->payment_terms)->format('Y-m-d') :
            now()->formatLocalized('%A %d %B %Y')

            }}<br />
        </div>
    </div>
    <br />
    <div style="clear:both; position:relative;">

        <div style="position:absolute; left:0pt; width:250pt;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div style="padding-left: 20pt;">
                        <h3>Customer Address:</h3>
                        {{ $invoice->company->name ?? $invoice->bookings->first()->name .' '.$invoice->bookings->first()->surname }}<br/>
                        {{-- {{ $invoice->company->address ? str_replace(',', '</br>', $invoice->company->address) : '' }}<br/> --}}
                        @foreach (explode(',', ($invoice->company->address ?? '')) as $address_line)
                            {{ $address_line }} <br/>
                        @endforeach
                        {{-- {{ $invoice->company->phone ?? $invoice->bookings->first()->phone}}<br/> --}}
                        {{-- {{ $invoice->company->tax ? 'ID: ' . $invoice->company->tax : '' }}<br/> --}}
                    </div>
                </div>
            </div>
        </div>


        <div style="margin-left: 300pt;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div style="padding-left: 20pt;">
                        <h4>Business Details:</h4>
                        {{ config('invoice_details.business_details.name') }}
                        {{-- <br /> ID: {{ config('invoice_details.business_details.id')}} --}}
                        <br /> {{ config('invoice_details.business_details.phone') }}
                        <br /> {{ config('invoice_details.business_details.location')}}
                        <br /> {{ config('invoice_details.business_details.zip') }} {{ config('invoice_details.business_details.city')
                        }} {{ config('invoice_details.business_details.country') }}<br />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h5 style="margin-top: 0px;">Items:</h5>
    <table>
        <thead>
            <tr bgcolor="black">
                <th style="width:5%;"><font color="white">#</font></th>
                <th style="width:10%;"><font color="white">Ref</font></th>
                <th style="border-right: none;"><font color="white">Item Name</font></th>
                <th style="width:20%; border-left: none;"></th>
                <th style="width:20%;"><font color="white">Price</font></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->bookings as $item)
            <tr>
                <td style="border-bottom: 1px solid #ddd;">{{ $loop->iteration }}</td>
                <td style="border-bottom: 1px solid #ddd;">{{ $item->id }}</td>
                <td style="border-bottom: 1px solid #ddd;">{{ $item->invoiceDescription() }}</td>
                <td style="border-bottom: 1px solid #ddd;"></td>
                <td style="border-bottom: 1px solid #ddd;">&euro;{{ $item->rateForInvoice() }}</td>
            </tr>
            @endforeach
                <tr border="0">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>&euro;{{ $invoice->totalForInvoice() }}</b></td>
                </tr>
            @if ($invoice->paymentsMadeForInvoice() > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Payments Made</td>
                    <td><font color="red">{{ '(-) ' . $invoice->paymentsMadeForInvoice() }}</font></td>
                </tr>
            @endif
            @if ($invoice->creaditNotesIssuedForInvoice() > 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Credits Issued</td>
                    <td><font color="red">{{ $invoice->creaditNotesIssuedForInvoice() > 0 ? '(-) ' . $invoice->creaditNotesIssuedForInvoice() : '0.00' }}</font></td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #f5f5f5;"><b>Balance Due</b></td>
                <td style="background-color: #f5f5f5;"><b>&euro;{{ $invoice->balanceDueForInvoice() }}</b></td>
            </tr>
        </tbody>
    </table>
    {{-- <div style="clear:both; position:relative;">
        <div style="margin-left: 350pt; padding-top: 10pt; margin-bottom: 20pt;">
            <table>
                <tbody>
                    <tr>
                        <td><b>Total</b></td>
                        <td><b>&euro;{{ $invoice->totalForInvoice() }}</b></td>
                    </tr>
                    <tr>
                        <td>Payments Made</td>
                        <td><font color="red">{{ $invoice->paymentsMadeForInvoice() > 0 ? '(-) ' . $invoice->paymentsMadeForInvoice() : '0.00' }}</font></td>
                    </tr>
                    <tr>
                        <td>Credits Issued</td>
                        <td><font color="red">{{ $invoice->creaditNotesIssuedForInvoice() > 0 ? '(-) ' . $invoice->creaditNotesIssuedForInvoice() : '0.00' }}</font></td>
                    </tr>
                    <tr>
                        <td><b>Balance Due</b></td>
                        <td><b>&euro;{{ $invoice->balanceDueForInvoice() }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
    @if ($invoice->status == 'paid')
                <div style="text-align: center;">
{{--                    <img src="{{asset('images/paid.png')}}" alt="" width="150px"/>--}}
                    <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('images/paid.png')))}}" width="150px"/>
                </div>
            @endif
    <div style="position: absolute;bottom: 0;width: 100%;">
        <h4>Bank details:</h4>
        <div class="panel panel-default">
            <div class="panel-body">
                Acc name: {{ config('invoice_details.bank_details.name')}}<br> Account number: {{ config('invoice_details.bank_details.number')}}
                <br> Sort Code: {{ config('invoice_details.bank_details.sort')}} <br> IBAN: {{ config('invoice_details.bank_details.iban')}}
                <br> BIC/SWIFT: {{ config('invoice_details.bank_details.swift')}} <br>
            </div>
        </div>
        <div class="well">
            {{ isset($invoice->company->payment_terms) ?
            ('Terms and Conditions: ' . $invoice->company->payment_terms . ' days from receipt of this invoice.') :
            ('Terms and Conditions: Payment due on the day of the receipt of this invoice.') }}
        </div>
    </div>

    @if (!$loop->last)
    <div style="page-break-after:always;"></div>
    @endif @endforeach
</body>

</html>
