<?php

class EventsVendorsOverviewControllerTest extends TestCase
{
    private $model;

    public function setUp()
    {
        parent::setUp();
        $this->session(['event_id' => 1]);

        $this->model = Mockery::mock('Eloquent', 'EventsVendorsMapping');
        App::instance('EventsVendorsMapping', $this->model);
    }

    public function tearDown()
    {
        Mockery::close();
        Session::forget('event_id');
    }

    public function testShowOverview_NoAssignedVendors_RedirectsToVendorAssign()
    {
        $this->model->shouldReceive('all')->once()->andThrow(new NoDataException());
        $this->call('GET', '/events/vendors/overview');
        $this->assertRedirectedTo('/events/vendors/assign');
    }

    public function testShowOverview_AssignedVendors_ReturnsDataToView()
    {
        $this->model->shouldReceive('all')->once()->andReturn(array());
        $this->call('GET', '/events/vendors/overview');
        $this->assertViewHas('vendors');
    }
}
