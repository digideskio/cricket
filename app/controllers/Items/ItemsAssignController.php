<?php

class ItemsAssignController extends BaseController
{
    private $item;
    private $mapping;

    public function __construct(Item $item, EventVendorItem $mapping)
    {
        $this->item = $item;
        $this->mapping = $mapping;
    }

    public function assignItem()
    {
        $this->addMappingAttributes();
        try {
            $this->mapping->save();
        } catch (Illuminate\Database\QueryException $e) {
            return Response::json(
                array('success' => 'no', 'message' => $e->getMessage()),
                200
            );
        }
        return Response::json(array('success' => 'yes'), 200);
    }

    private function addMappingAttributes()
    {
        $this->mapping->event_id = Session::get('event_id');
        $this->mapping->vendor_id = Route::input('vendor_id');
        $this->mapping->item_id = Input::get('item_id');
    }
}
