<?php

class EventsVendorsOverviewController extends BaseController
{
    private $model;

    public function __construct(EventsVendorsMapping $model)
    {
        $this->model = $model;
    }

    public function showOverview()
    {
        try {
            $mapped = $this->model->all();
        } catch (NoDataException $e) {
            return Redirect::to('/events/vendors/assign');
        }
        return View::make('Events/Vendors/overview', array('vendors' => $mapped));
    }
}