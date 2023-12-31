<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $invoice->name }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            h1,h2,h3,h4,h5,h6,p,span,div { font-family: DejaVu Sans; 
            /* font-size:8px; */
             }

             th,td { font-family: DejaVu Sans; 
            font-size:12px;
             }
        </style>
        
    </head>
    <body>
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:250pt;">
                <img class="img-rounded" height="{{ $invoice->logo_height }}" src="{{ $invoice->logo }}">
            </div>
            <div style="margin-left:300pt;">
                <h5>
                        <b>Date: </b> {{ $invoice->date->formatLocalized('%A %d %B %Y') }}<br />
                        @if ($invoice->number())
                            <b>Invoice #: </b> {{ $invoice->number() }}
                        @endif
                        <br />
                </h5>
            </div>
        </div>
        <br />
        {{-- <h3>
            {{ $invoice->name }} {{ $invoice->number ? '#' . $invoice->number : '' }}
        </h3> --}}
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:250pt;">
                <h5>Business Details:</h5>
                <div class="panel panel-default">
                    <h6>
                        <div class="panel-body" style="padding-top: 0px;">
                        {{-- {!! $invoice->business_details->count() == 0 ? '<i>No business details</i><br />' : '' !!} --}}
                        name</br>{{-- {{ $invoice->business_details->get('name') }}<br /> --}}
                        name</br>{{-- tax: {{ $invoice->business_details->get('id') }}<br /> --}}
                        name</br>{{-- {{ $invoice->business_details->get('phone') }}<br /> --}}
                        name</br>{{-- {{ $invoice->business_details->get('location') }}<br /> --}}
                        name</br>{{-- {{ $invoice->business_details->get('zip') }} {{ $invoice->business_details->get('city') }}<br /> --}}
                        name</br>{{-- {{ $invoice->business_details->get('country') }}<br /> --}}
                    </div>
                </h6>
                </div>
            </div>
            <div style="margin-left: 300pt; width:250pt;">
                <h5 style="padding-top: 0px;">Customer Details:</h5>
                <h6>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{-- {!! $invoice->customer_details->count() == 0 ? '<i>No customer details</i><br />' : '' !!} --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('name') }}<br /> --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('tax') ? 'tax: ' . $invoice->customer_details->get('tax') : '' }}<br /> --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('phone') }}<br /> --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('location') }}<br /> --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('zip') }} {{ $invoice->customer_details->get('city') }}<br /> --}}
                            name customer </br>{{-- {{ $invoice->customer_details->get('country') }}<br /> --}}
                        </div>
                    </div>
                </h6>
                
            </div>
        </div>
        <h5 style="margin-top: 25px;">
            Items:
        </h5>
        <table class="table table-bordered">
            <thead>
               <tr>
                    <th>#</th>
                    {{-- <th>id</th> --}}
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($invoice->items as $item) --}}
                    <tr>
                        <td>item</td>{{-- <td>{{ $loop->iteration }}</td> --}}
                        {{-- <td>{{ $item->get('id') }}</td> --}}
                        <td>item</td>{{-- <td>{{ $item->get('name') }}</td> --}}
                        <td>item</td>{{-- <td>{{ $item->get('price') }} {{ $invoice->formatCurrency()->symbol }}</td> --}}
                        <td>item</td>{{-- <td>{{ $item->get('ammount') }}</td> --}}
                        <td>item</td>{{-- <td>{{ $item->get('totalPrice') }} {{ $invoice->formatCurrency()->symbol }}</td> --}}
                        
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
        <div style="clear:both; position:relative;">
            {{-- @if($invoice->bank_details) --}}
                <div style="position:absolute; left:0pt; width:250pt;">
                    <h5>CIT Bank Details</h5>
                    <h6>
                        <div class="panel panel-default">
                                <div class="panel-body" style="padding-top: 0px;">
                                        Bank of Ireland <br>
                                        Acc name: Construction Industry Training Ltd <br>
                                        Account number: 78384868 <br>
                                        Sort Code: 90-04-20 <br>
                                        IBAN: IE92BOFI90042078384868 <br>
                                        BIC/SWIFT: BOFIIE2D <br>
                                </div>
                        </div>
                    </h6>
                </div>
            {{-- @endif --}}
            <div style="margin-left: 300pt; padding-top: 30pt; margin-bottom: 40pt;">
                {{-- <h5>Total:</h5> --}}
                <table class="table table-bordered">
                    <tbody>
                        {{-- <tr>
                            <td><b>Subtotal</b></td>
                            <td>{{ $invoice->subTotalPriceFormatted() }} {{ $invoice->formatCurrency()->symbol }}</td>
                        </tr> --}}
                        {{-- <tr>
                            <td>
                                <b>
                                    Taxes {{ $invoice->tax_type == 'percentage' ? '(' . $invoice->tax . '%)' : '' }}
                                </b>
                            </td>
                            <td>{{ $invoice->taxPriceFormatted() }} {{ $invoice->formatCurrency()->symbol }}</td>
                        </tr> --}}
                        <tr>
                            <td><b>TOTAL</b></td>
                            <td><b>234</b></td>{{-- <td><b>{{ $invoice->totalPriceFormatted() }} {{ $invoice->formatCurrency()->symbol }}</b></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- @if ($invoice->footnote) --}}
            <br /><br />
            <h6>
                <div class="well">
                        some text{{-- {{ $invoice->footnote }} --}}
                </div>
            </h6>
        {{-- @endif --}}
    </body>
</html>
