<?php

Route::get('/', 'HomeController@showOverview');

Route::get('/events/select', 'EventsSelectController@showOverview');

Route::post('/events/add', 'EventsAddController@add');

Route::get('/events/new', function() {
    return View::make('/Events/new');
});
