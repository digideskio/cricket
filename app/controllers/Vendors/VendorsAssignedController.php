<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class VendorsAssignedController extends BaseController
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
        } catch (ModelNotFoundException $e) {
            return Redirect::to('/vendors/assign')->with('message', 'Please add vendors to event');
        }
        return View::make('Vendors/assigned', $this->getMesssageArray(array('vendors' => $mapped)));
    }

    private function getActiveAssignedVendors()
    {
        $mapped = $this->model->leftJoin('vendors', function($join) {
                $join->on('events_vendors_mappings.vendor_id', '=', 'vendors.id');
            })
            ->where('event_id', '=', Session::get('event_id'))
            ->where('active', '=', 'yes')
            ->orderBy('events_vendors_mappings.id', 'ASC')->get();

        if ($mapped->count() === 0) {
            throw new ModelNotFoundException();
        }
        return $mapped;
    }
}