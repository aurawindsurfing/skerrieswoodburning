<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{-- <title>{{ $invoice->name }}</title> --}}
        <style>

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        h1,h2,h3,h4,h5,h6,p,span,div { 
            font-family: DejaVu Sans; 
            font-size:10px;
            font-weight: normal;
        }

        th,td { 
            font-family: DejaVu Sans; 
            font-size:10px;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
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

        thead  {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }

        th, td  {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        }

        </style>
    </head>
    <body>
    @foreach ($invoices as $invoice)
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:250pt;">
            <img src="{{asset(config('invoice_details.logo'))}}" alt="" width="{{ config('invoice_details.logo_width') }}"/>
            </div>
            <div style="margin-left:300pt;">
                <b>Date: </b> {{ now()->formatLocalized('%A %d %B %Y') }}<br />
                {{-- @if ($invoice->number()) --}}
                    <b>Invoice #: </b> {{ $invoice->number() }}
                {{-- @endif --}}
                <br />
            </div>
        </div>
        <br />
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:250pt;">
                <h4>Business Details:</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ config('invoice_details.business_details.name') }}<br />
                        ID: {{ config('invoice_details.business_details.id') }}<br />
                        {{ config('invoice_details.business_details.phone') }}<br />
                        {{ config('invoice_details.business_details.location') }}<br />
                        {{ config('invoice_details.business_details.zip') }} {{ config('invoice_details.business_details.city') }}
                        {{ config('invoice_details.business_details.country') }}<br />
                    </div>
                </div>
            </div>
            <div style="margin-left: 300pt;">
                <h4>Customer Details:</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{-- {!! $invoice->customer_details->count() == 0 ? '<i>No customer details</i><br />' : '' !!} --}}
                        {{ isset($invoice->company->name) ? $invoice->company->name : $invoice->bookings->first()->name .' '. $invoice->bookings->first()->surname }}<br />
                        ID: {{ isset($invoice->company->tax) ? $invoice->company->tax : '' }}<br />
                        {{ isset($invoice->company->phone) ? $invoice->company->phone : $invoice->bookings->first()->phone }}<br />
                        {{ isset($invoice->company->address) ? $invoice->company->address : '' }}<br />

                    </div>
                </div>
            </div>
        </div>
        <h5 style="margin-top: 0px;">Items:</h5>
        <table>
            <thead>
                <tr>
                    <th style="width:10%;">#</th>
                    <th style="width:10%;">ref</th>
                    <th>Item Name</th>
                    <th style="width:20%;">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->bookings as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rateForInvoice() }} &euro;</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="clear:both; position:relative;">
                <div style="margin-left: 350pt; padding-top: 10pt; margin-bottom: 20pt;">
                    {{-- <h5>Total:</h5> --}}
                    <table>
                        <tbody>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>{{ $invoice->total() }} &euro;</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="position: absolute;bottom: 0;width: 100%;">
                    <h4>Bank details:</h4>
                    <div class="panel panel-default">
                            <div class="panel-body">
                                    Acc name: {{ config('invoice_details.bank_details.name')}}<br>
                                    Account number: {{ config('invoice_details.bank_details.number')}} <br>
                                    Sort Code: {{ config('invoice_details.bank_details.sort')}} <br>
                                    IBAN: {{ config('invoice_details.bank_details.iban')}} <br>
                                    BIC/SWIFT: {{ config('invoice_details.bank_details.swift')}} <br>
                            </div>
                    </div>
                    <div class="well">
                        {{ config('invoice_details.footnote') }}
                    </div>
            </div>
        
            @if (!$loop->last)
                <div style="page-break-after:always;"></div>
            @endif
            
    @endforeach
    </body>
</html>
