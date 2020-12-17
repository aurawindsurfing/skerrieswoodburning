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

$redirect_array = [
    '/contact-us/' => 'https://cit.test/bespoke_solution/10',
    '/solas-safe-pass/' => 'https://cit.test/list/1/solas-safe-pass',
    '/locations/parslickstown-house-4/' => '/',
    '/locations/cit-ltd/' => '/',
    '/locations/cit-training-room-8/' => '/',
    '/locations/cit-training-room-10/' => '/',
    '/locations/cit-training-room-12/' => '/',
    '/locations/cit-training-room-13/' => '/',
    '/locations/dunboyne-castle-hotel/' => '/',
    '/events/location-of-underground-services/' => '/',
    '/events/categories/qqi/' => '/',
    '/events/ladder-safety/' => '/',
    '/events/forklift/' => '/',
    '/events/power-pallet-truck/' => '/',
    '/events/chemical-awareness/' => '/',
    '/events/spill-kit/' => '/',
    '/events/temporary-works/' => '/',
    '/events/lock-out-tag-out/' => '/',
    '/events/confined-spaces-search-rescue/' => '/group/7/confined-spaces',
    '/events/working-at-heights/' => '/group/2/working-at-heights',
    '/events/vehicle-banksman/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/emergency-first-aid/' => 'https://cit.test/group/5/first-aid',
    '/events/firewarden/' => 'https://cit.test/group/11/other-courses',
    '/events/confined-spaces-management/' => 'https://cit.test/group/7/confined-spaces',
    '/events/confined-spaces-medium-risk/' => 'https://cit.test/group/7/confined-spaces',
    '/events/abrasive-wheels/' => 'https://cit.test/group/6/abrasive-wheels',
    '/events/confined-spaces-high-risk/' => 'https://cit.test/group/7/confined-spaces',
    '/events/occupational-first-aid/' => 'https://cit.test/group/5/first-aid',
    '/events/wewp/' => 'https://cit.test/group/1/mewp',
    '/events/patient-handling-instructor/' => 'https://cit.test/group/5/first-aid',
    '/events/safe-use-of-harnesses/' => 'https://cit.test/group/2/working-at-heights',
    '/events/confined-spaces-low-risk/' => 'https://cit.test/group/7/confined-spaces',
    '/events/training-delivery-and-evaluation-train-the-trainer/' => 'https://cit.test/group/12/instructor-courses',
    '/events/patientpeople-handling/' => 'https://cit.test/group/5/first-aid',
    '/events/ride-on-roller/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/cscs-mobile-access-tower-scaffold/' => 'https://cit.test/group/1/mewp',
    '/events/cscs-360-degree-excavator/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/cscs-180-degree-excavator/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/cscs-slinger-signaller/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/cscs-site-dumper/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/cscs-teleporter/' => 'https://cit.test/group/10/plant-and-machinery',
    '/events/solas-safe-pass-old/' => 'https://cit.test/list/1/solas-safe-pass',
];

foreach ($redirect_array as $key => $value){
    Route::redirect($key, $value, 301);
}

Route::get('/', 'PageController@index')->name('home');
Route::get('/bespoke_solution/{type?}', 'PageController@bespoke')->name('bespoke');
Route::post('/contact', 'ContactFormController@send')->name('send_enquiry');

Route::get('/group/{group}/{slug?}', 'PageController@group')->name('group');
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
