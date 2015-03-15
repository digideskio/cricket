<?php

class VendorsAssignController extends BaseController
{
    private $vendor;
    private $mapping;

    public function __construct(Vendor $vendor, EventVendor $mapping)
    {
        $this->vendor = $vendor;
        $this->mapping = $mapping;
    }

    public function showVendors()
    {
        $vendors = $this->getVendors();
        if ($vendors->count() === 0) {
            $vendors = array();
        }
        return View::make('Vendors/assign', array('vendors' => $vendors));
    }

    private function getVendors()
    {
        return $this->vendor->whereNotIn('id', function($query){
            $query->select('vendor_id')
                ->from('event_vendor')
                ->where('event_id', Session::get('event_id'));
        })->get();
    }

    public function assignVendor()
    {
        try {
            $this->addMappingAttributes();
            $this->mapping->save();
        } catch (NoDataException $e) {
            return Response::json(
                array('success' => 'no', 'message' => 'Unable to assign vendor'),
                200
            );
        } catch (Illuminate\Database\QueryException $e) {
            return Response::json(
                array('success' => 'no', 'message' => 'Unable to assign vendor'),
                200
            );
        } catch (DataSaveException $e) {
            return Response::json(
                array('success' => 'no', 'message' => $e->getMessage()),
                200
            );
        }
        return Response::json(array('success' => 'yes'), 200);
    }

    private function addMappingAttributes()
    {
        $mapped = $this->mapping->where('event_id', '=', Session::get('event_id'))
            ->where('vendor_id', '=', Input::get('vendor_id'))
            ->where('active', '=', 'yes')
            ->take(1)->get();
        if ($mapped->count() > 0) {
            throw new DataSaveException(array('Vendor already assigned to event'));
        }
        
        $this->mapping->event_id = Session::get('event_id');
        $this->mapping->vendor_id = Input::get('vendor_id');
    }
}
