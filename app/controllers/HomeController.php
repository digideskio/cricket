<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController {

	public function showOverview()
	{
        //Session::forget('event_id');
        $event_id = Session::get('event_id');
		if (empty($event_id) === true) {
            return Redirect::to('/events/select');
        } else {
            return Redirect::to('/events/vendors/overview');
        }
	}
}
