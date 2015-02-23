<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventsSelectControllerTest extends TestCase
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

    public function testSelectEvent_NoExistingEvents_RedirectsToNewEvent()
    {
        $this->model->shouldReceive('all')->once()->andThrow(new ModelNotFoundException());
        $this->call('GET', '/events/select');
        $this->assertRedirectedTo('/events/new');
    }

    public function testSelectEvent_ExistingEvents_ReturnsEvents()
    {
        $this->session(array('message' => 'message'));
        $this->model->shouldReceive('all')->once()->andReturn(array());
        $this->call('GET', '/events/select');
        $this->assertViewHas('events');
        $this->assertViewHas('message');
    }

    public function testAssignSelected_NoExistingEvent_ReturnsFailureResponse()
    {
        $this->model->shouldReceive('findOrFail')->once()->andThrow(new ModelNotFoundException());
        $returned = $this->call('POST', '/events/select');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignSelected_ExistingEvent_AssignsEvent()
    {
        $event = new stdClass();
        $event->id = 1;

        $this->model->shouldReceive('findOrFail')->once()->andReturn($event);
        $returned = $this->call('POST', '/events/select');
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
