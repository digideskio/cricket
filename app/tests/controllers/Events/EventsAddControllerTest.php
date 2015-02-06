<?php

class EventsAddControllerTest extends TestCase
{
    private $model;

    public function setUp()
    {
        parent::setUp();

        $this->model = Mockery::mock('Eloquent', 'Events');
        App::instance('Events', $this->model);
    }

    public function tearDown()
    {
        Mockery::close();
        Session::forget('event_id');
    }

    public function testAddEvent_AddingFails_ReturnsFailureJSON()
    {
        $this->model->shouldReceive('create')->once()->andThrow(new DataFailureException());
        $returned = $this->call('POST', '/events/add');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddEvent_AddingSuccess_ReturnsAddedId()
    {
        $event = new stdClass();
        $event->id = 1;
        $this->model->shouldReceive('create')->once()->with(array('description' => 'default'))->andReturn($event);
        $returned = $this->call('POST', '/events/add');
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
