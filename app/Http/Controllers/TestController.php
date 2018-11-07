<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class TestController extends Controller
{
    public function test()
    {
        $invoice = new Invoice();

        $invoice->prefix('N-');
        $invoice->date(Carbon::now());
        $invoice->status('new');

        $invoice->save();

    }
}
