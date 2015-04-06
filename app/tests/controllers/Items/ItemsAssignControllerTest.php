<?php

class ItemsAssignControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        Session::forget('event_id');
    }

    public function testGetItems_ItemsExist_ReturnsExpectedData()
    {
        $this->prepareData();
        $returned = $this->call('GET', '/items/assign/1');
        $data = $returned->getOriginalContent();

        $count = 0;
        foreach ($data['items'] as $item) {
            $this->assertEquals('desc' . $count++, $item['description']);
        }
        $this->assertEquals(2, $count);
    }

    public function testAssignItem_AssignSuccess_AssignsItem()
    {
        $this->prepareData();

        $this->call(
            'POST',
            '/items/assign/1',
            array(
                'item_ids' => array(1, 2),
                'item_count_1' => 0,
                'item_count_2' => 1,
            )
        );

        $mappings = EventVendorItem::orderBy('vendor_id')->get();
        $count = 0;
        foreach ($mappings as $mapping) {
            $this->assertEquals($count, $mapping->amount);
            $this->assertEquals(++$count, $mapping->item_id);
            $this->assertEquals(2, $mapping->event_vendor_item_group_id);
        }
        $this->assertEquals(2, $count);
    }

    private function prepareData()
    {
        $this->session(array('event_id' => 1));

        $event = new Events();
        $event->description = 'desc';
        $event->save();

        $vendor = new Vendor();
        $vendor->aka = 'aka1';
        $vendor->name = 'name';
        $vendor->surname = 'surname';
        $vendor->id_number = 'id_number';
        $vendor->save();

        $item = new Item();
        $item->description = 'desc1';
        $item->price = 1;
        $item->starting_amount = 1;
        $item->position = 2;
        $item->save();

        $item = new Item();
        $item->description = 'desc0';
        $item->price = 2;
        $item->starting_amount = 2;
        $item->position = 1;
        $item->save();

        $group = new EventVendorItemGroup();
        $group->save();
    }
}
