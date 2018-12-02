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

Route::get('pdftest1', 'TestController@pdftest1');

Route::get('pdftest2', 'TestController@pdftest2');

Route::get('test', 'TestController@test');
