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

    public function testAssignItem_FailureOccurs_ReturnsFailureResponse()
    {
        $this->session(array('event_id' => 1));
        $returned = $this->call('POST', '/items/assign/1');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignItem_AssignSuccess_AssignsItem()
    {
        $this->prepareData();

        $returned = $this->call(
            'POST',
            '/items/assign/1',
            array(
                'vendor_id' => 1,
                'item_id' => 1,
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
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
        $item->description = 'desc';
        $item->price = 1;
        $item->starting_amount = 1;
        $item->save();
    }
}
