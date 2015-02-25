<?php

class EventsAddControllerTest extends TestCase
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

    public function testAddEvent_AddingFails_ReturnsFailureJSON()
    {
        $returned = $this->call('POST', '/events/new', array('name' => 'name'));
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddEvent_AddingSuccess_ReturnsAddedId()
    {
        $returned = $this->call(
            'POST',
            '/events/new',
            array(
                'description' => 'desc',
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
