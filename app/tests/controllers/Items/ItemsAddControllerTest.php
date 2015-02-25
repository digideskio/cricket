<?php

class ItemsAddControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
    }

    public function testAdd_incorrectData_returnsFailure()
    {
        $returned = $this->call('POST', '/items/new', array('price' => 'yes'));
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddItem_AddingSuccess_ReturnsItem()
    {
        $returned = $this->call(
            'POST',
            '/items/new',
            array(
                'description' => 'desc',
                'price' => 12,
                'starting_amount' => 5,
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
