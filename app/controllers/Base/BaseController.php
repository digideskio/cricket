<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function getMesssageArray($additional)
	{
		$message = Session::has('message') === true
			? array('message' => Session::get('message'))
			: array();
		return array_merge($additional, $message);
	}
}
