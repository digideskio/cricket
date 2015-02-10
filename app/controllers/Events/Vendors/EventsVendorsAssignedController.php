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
            return Redirect::to('/events/vendors/assign');
        }
        return View::make('Events/Vendors/assigned', array('vendors' => $mapped));
    }
}