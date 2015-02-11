<?php

class EventsVendorsAssignControllerTest extends TestCase
{
    private $vendor;
    private $mapping;

    public function setUp()
    {
        parent::setUp();

        $this->vendor = Mockery::mock('Eloquent', 'Vendor');
        App::instance('Vendor', $this->vendor);

        $this->mapping = Mockery::mock('Eloquent', 'EventsVendorsMapping');
        App::instance('EventsVendorsMapping', $this->mapping);

        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testShowVendors_NoVendors_RedirectsToVendorNew()
    {
        $this->vendor->shouldReceive('all')->once()->andThrow(new NoDataException());
        $this->call('GET', '/events/vendors/assign');
        $this->assertRedirectedTo('/vendors/new');
    }

    public function testShowVendors_VendorsExist_ReturnsDataToView()
    {
        $this->vendor->shouldReceive('all')->once()->andReturn(array());
        $this->call('GET', '/events/vendors/assign');
        $this->assertViewHas('vendors');
    }

    public function testAssignVendor_FailureOccurs_ReturnsFailureResponse()
    {
        $this->mapping->shouldReceive('create')->once()->andThrow(new NoDataException());
        $returned = $this->call('POST', '/events/vendors/assign');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignVendor_AssignSuccess_AssignsVendor()
    {
        $mapping = new stdClass();
        $mapping->id = 1;

        $this->mapping->shouldReceive('create')->once()->andReturn($mapping);
        $returned = $this->call('POST', '/events/vendors/assign');
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
