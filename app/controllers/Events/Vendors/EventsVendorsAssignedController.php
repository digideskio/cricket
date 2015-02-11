<?php

class EventsVendorsAssignedController extends BaseController
{
    private $model;

    public function __construct(EventsVendorsMapping $model)
    {
        $this->model = $model;
    }

    public function showAssigned()
    {
        try {
            $mapped = $this->model->all();
        } catch (NoDataException $e) {
            return Redirect::to('/events/vendors/assign')->with('message', 'Please add vendors to event');
        }
        return View::make('Events/Vendors/assigned', $this->getMesssageArray(array('vendors' => $mapped)));
    }
}