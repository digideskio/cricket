<?php

class ItemsAssignedControllerTest extends TestCase
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

    public function testGetAssignedItems_ItemsExist_ReturnsExpectedData()
    {
        //TODO: write tests to prove that assigned items are returned by group 
        $this->session(array('event_id' => 1));

        $returned = $this->call('GET', '/items/assigned/1');
        $data = $returned->getOriginalContent();

        $count = 0;
        foreach ($data['items'] as $item) {
            $this->assertEquals($count++, $item['description']);
        }
        $this->assertEquals(2, $count);
    }
}
