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
    
    public function getItems()
    {
        $items = Item::where('active', '=', 'yes')->orderBy('position')->get();
        return View::make(
            'Items/assign',
            array('items' => $items, 'vendor_id' => (int)Route::input('vendor_id'))
        );
    }

    public function assignItems()
    {
        $group = new EventVendorItemGroup();
        $group->save();
        foreach (Input::get('item_ids') as $item_id) {
            $mapping = new $this->mapping;
            $mapping->amount = (int)Input::get('item_count_' . $item_id);
            $mapping->event_id = (int)Session::get('event_id');
            $mapping->vendor_id = (int)Route::input('vendor_id');
            $mapping->item_id = (int)$item_id;
            $mapping->event_vendor_item_group_id = $group->id;
            $mapping->save();
        }
        return Response::json(array('success' => 'yes'), 200);
    }
}
