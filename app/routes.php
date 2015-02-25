<?php

Route::get('/', 'HomeController@showOverview');

new EventsRouter();
new VendorsRouter();
new ItemsRouter();
