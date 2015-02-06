<?php

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
    }

    public function testSelectEvent_NoExistingEvents_RedirectsToNewEvent()
    {
        $this->model->shouldReceive('all')->once()->andThrow(new NoDataException());
        $this->call('GET', '/events/select');
        $this->assertRedirectedTo('/events/new');
    }

    public function testSelectEvent_ExistingEvents_ReturnsEvents()
    {
        $this->model->shouldReceive('all')->once()->andReturn(array());
        $this->call('GET', '/events/select');
        $this->assertViewHas('events');
    }
}
