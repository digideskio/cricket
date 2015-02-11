<?php

class EventsVendorsAssignController extends BaseController
{
    private $vendor;
    private $mapping;

    public function __construct(Vendor $vendor, EventsVendorsMapping $mapping)
    {
        $this->vendor = $vendor;
        $this->mapping = $mapping;
    }

    public function showVendors()
    {
        try {
            $vendors = $this->vendor->all();
        } catch (NoDataException $e) {
            return Redirect::to('/vendors/new')->with('message', 'Please add vendors to the system');
        }
        return View::make('Events/Vendors/assign', array('vendors' => $vendors));
    }

    public function assignVendor()
    {
        try {
            $this->mapping->create(
                array(
                    'event_id' => Session::get('event_id'),
                    'vendor_id' => Input::get('vendor_id'),
                )
            );
        } catch (NoDataException $e) {
            return Response::json(
                array('success' => 'no', 'message' => 'Unable to assign vendor'),
                200
            );
        }
        return Response::json(array('success' => 'yes'), 200);
    }
}
