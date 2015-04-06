<?php

class ItemsAssignedController extends BaseController
{
    private $mapping;

    public function __construct(EventVendorItem $mapping)
    {
        $this->mapping = $mapping;
    }
    
    public function getAssigned()
    {
        //TODO: get assigned groups, and from there the assigned items and amounts
        $items = Item::where('active', '=', 'yes')->orderBy('position')->get();
        return View::make(
            'Items/assign',
            array('items' => $items, 'vendor_id' => (int)Route::input('vendor_id'))
        );
    }
}
