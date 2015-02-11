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

	protected function validateData($data, $rules)
	{
		$validator = Validator::make($data, $rules);

		if ($validator->fails() === true) {
			$msg = 'Could not save for the following reason(s):';
			foreach ($validator->messages()->all() as $failed) {
				$msg .= ' ' . $failed;
			}
			throw new DataFailureException($msg);
		}
	}
}
