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

Route::get('/', 'PageController@index')->name('home');
Route::get('/bespoke_solution/{type?}', 'PageController@bespoke')->name('bespoke');
Route::post('/contact', 'ContactFormController@send')->name('send_enquiry');

Route::get('/group/{slug}', 'PageController@group')->name('group');
Route::get('/list/{type?}/{slug?}', 'PageController@list')->name('list');

Route::get('/booking/create/{course}/{slug?}', 'BookingController@create')->name('create-booking');
Route::post('/booking', 'BookingController@store')->name('store-booking');

Route::post('stripe/webhook', 'WebhookController@handleWebhook');

// Route::redirect('/', '/office', 301);

// Route::redirect('/nova', '/office', 301);

// Route::redirect('/', '/resources/bookings');

// Route::get('pdftest1', 'TestController@pdftest1');
// Route::get('pdftest2', 'TestController@pdftest2');
// Route::get('pdftest3', 'TestController@pdftest3');
// Route::get('pdftest4', 'TestController@pdftest4');
// Route::get('pdftest5', 'TestController@pdftest5');


//Route::get('test', 'TestController@test');
// Route::get('test2', 'TestController@test2');
