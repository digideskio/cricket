<?php

class ItemsAssignController extends BaseController
{
    private $item;
    private $mapping;

    public function __construct(Item $item, VendorsItemsMapping $mapping)
    {
        $this->item = $item;
        $this->mapping = $mapping;
    }

    public function assignItem()
    {
        $this->addMappingAttributes();
        if ($this->mapping->save() === false) {
            return Response::json(
                array('success' => 'no', 'message' => $this->mapping->errorString()),
                200
            );
        }
        return Response::json(array('success' => 'yes'), 200);
    }

    private function addMappingAttributes()
    {
        $this->mapping->event_id => Session::get('event_id');
        $this->mapping->vendor_id => Input::get('vendor_id');
        $this->mapping->item_id => Input::get('item_id');
    }
}
