<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
        
    @include('emails.partials.header')

    <div class="container ml-6 max-w-m">
        {{ isset($invoices->first()->company->accounts_payable->first()->name) ? 
        $invoices->first()->company->accounts_payable->first()->name . ', thank you for your bookings with CIT. ' : 
        $invoices->first()->company->contact->first()->name . ', thank you for your bookings with CIT. '}}
        <br><br>
        We noticed that some of your invoices are due next week. Please see details below:
        <br><br>
    </div>

    @foreach ($invoices as $invoice)

        <div class="container ml-6 max-w-m">
            Invoice number: {{ $invoice->number() }}<br>
            Invoice total: <b>{{ $invoice->totalForInvoice() }}e</b><br>
            <br>
        </div>

    @endforeach

    <div class="container ml-6 max-w-m">
        Grand total: <b>{{ $invoices->sum('total') }}e</b><br><br>
        We will appreciate if you can make arrangements to pay them this week.<br>
        <br><br>
        With Best Regards<br>
    </div>

    @component('emails.partials.footer')
        <div class="font-bold">{{ $invoices->first()->user->name }}</div> 
    @endcomponent
    
</body>
</html>



