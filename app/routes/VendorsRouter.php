<?php

class VendorsRouter
{
    public function __construct()
    {
        Route::post('/vendors/new', 'VendorsAddController@add');
        Route::get('/vendors/new', function() {
            if (Session::has('message') === true) {
                return View::make('/Vendors/new')->with('message', Session::get('message'));
            } else {
                return View::make('/Vendors/new');
            }
        });
        Route::get('/vendors/assigned', 'VendorsAssignedController@showAssigned');
        Route::get('/vendors/assign', 'VendorsAssignController@showVendors');
        Route::post('/vendors/assign', 'VendorsAssignController@assignVendor');
    }
}
