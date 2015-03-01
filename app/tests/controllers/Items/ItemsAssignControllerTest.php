<?php

class ItemsAssignControllerTest extends TestCase
{
    private $item;
    private $mapping;

    public function setUp()
    {
        $this->session(array('event_id' => 1));
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
        $returned = $this->call('POST', '/items/assign');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignItem_IncorectKeys_ReturnsFailureResponse()
    {
        $this->markTestIncomplete();
        $returned = $this->call('POST', '/items/assign');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignItem_AssignSuccess_AssignsItem()
    {
        $returned = $this->call(
            'POST',
            '/items/assign',
            array(
                'vendor_id' => 1,
                'item_id' => 1,
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
