<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/office', 301);

Route::redirect('/nova', '/office', 301);



// Route::get('/test', function () {
    
    
//     $invoice = ConsoleTVs\Invoices\Classes\Invoice::make()
//         ->addItem('test 1', 5, 2, 10)
//         ->addItem('test 2', 5, 2, 10)
//         ->addItem('test 3', 5, 2, 10)
//         ->addItem('test 4', 5, 2, 10)
    
//         ->number(4021)
//         // ->tax(21)
        
//         ->customer([
//             'name' => 'Tomasz Lotocki',
//             'id' => '4678434P',
//             'phone' => '+353862194744',
//             'location' => '11 The Tides',
//             'zip' => 'Skerries',
//             'city' => 'Skerries',
//             'country' => 'Ireland', 
//         ])
        
//         // ->download('demo');

//         ->save('public/tmp/invoices/myinvoicename.pdf');

//     // ;return view('vendor/invoices/default', compact('invoice'));

// });

Route::get('test', 'TestController@test');
