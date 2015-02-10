<?php

Route::get('/', 'HomeController@showOverview');

Route::get('/events/select', 'EventsSelectController@showOverview');
Route::post('/events/select', 'EventsSelectController@assignSelected');
Route::post('/events/add', 'EventsAddController@add');
Route::get('/events/new', function() {
    return View::make('/Events/new');
});

Route::get('/events/vendors/assigned', 'EventsVendorsAssignedController@showAssigned');
Route::get('/events/vendors/assign', 'EventsVendorsAssignController@showVendors');

Route::post('/vendors/add', 'VendorsAddController@add');
Route::get('/vendors/new', function() {
    return View::make('/Vendors/new');
});