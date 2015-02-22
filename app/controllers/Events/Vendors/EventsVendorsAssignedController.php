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
            $mapped = $this->getActiveAssignedVendors();
        } catch (NoDataException $e) {
            return Redirect::to('/events/vendors/assign')->with('message', 'Please add vendors to event');
        }
        return View::make('Events/Vendors/assigned', $this->getMesssageArray(array('vendors' => $mapped)));
    }

    private function getActiveAssignedVendors()
    {
        $mapped = $this->model->leftJoin('vendors', function($join) {
                $join->on('events_vendors_mappings.vendor_id', '=', 'vendors.id');
            })
            ->where('event_id', '=', Session::get('event_id'))
            ->where('active', '=', 'yes')->get();

        if ($mapped->count() === 0) {
            throw new NoDataException();
        }
        return $mapped;
    }
}