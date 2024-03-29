<?php

class ItemsRouter
{
    public function __construct()
    {
        Route::post('/items/new', 'ItemsAddController@add');
        Route::get('/items/new', function() {
            if (Session::has('message') === true) {
                return View::make('/items/new')->with('message', Session::get('message'));
            } else {
                return View::make('/items/new');
            }
        });

        Route::post('/items/assign/{vendor_id}', 'ItemsAssignController@assignItems');
        Route::get('/items/assign/{vendor_id}', 'ItemsAssignController@getItems');
        Route::get('/items/assigned/{vendor_id}', 'ItemsAssignedController@getAssigned');
    }
}
