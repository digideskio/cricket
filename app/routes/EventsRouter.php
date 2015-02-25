<?php

class EventsRouter
{
    public function __construct()
    {
        Route::get('/events/select', 'EventsSelectController@showOverview');
        Route::post('/events/select', 'EventsSelectController@assignSelected');
        Route::post('/events/new', 'EventsAddController@add');
        Route::get('/events/new', function() {
            if (Session::has('message') === true) {
                return View::make('/Events/new')->with('message', Session::get('message'));
            } else {
                return View::make('/Events/new');
            }
        });
    }
}
