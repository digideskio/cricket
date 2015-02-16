<?php

class EventsVendorsAssignControllerTest extends TestCase
{
    private $vendor;
    private $mapping;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Mockery::close();
        Artisan::call('migrate:reset');
    }

    public function testShowVendors_NoVendors_RedirectsToVendorNew()
    {
        $this->setupMocks();

        $this->vendor->shouldReceive('whereNotIn')->once()->andThrow(new NoDataException());
        $this->call('GET', '/events/vendors/assign');
        $this->assertRedirectedTo('/vendors/new');
    }

    public function testShowVendors_VendorsExist_ReturnsDataToView()
    {
        $this->prepareData();

        $returned = $this->call('GET', '/events/vendors/assign');
        $data = $returned->getOriginalContent();

        $count = 0;
        foreach ($data['vendors'] as $vendor) {
            $this->assertEquals(2, $vendor['id']);
            $count++;
        }
        $this->assertEquals(1, $count);
    }

    public function testAssignVendor_FailureOccurs_ReturnsFailureResponse()
    {
        $this->setupMocks();

        $this->mapping->shouldReceive('create')->once()->andThrow(new NoDataException());
        $returned = $this->call('POST', '/events/vendors/assign');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAssignVendor_AssignSuccess_AssignsVendor()
    {
        $this->setupMocks();

        $mapping = new stdClass();
        $mapping->id = 1;

        $this->mapping->shouldReceive('create')->once()->andReturn($mapping);
        $returned = $this->call('POST', '/events/vendors/assign');
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }

    private function setupMocks()
    {
        $this->vendor = Mockery::mock('Eloquent', 'Vendor');
        App::instance('Vendor', $this->vendor);

        $this->mapping = Mockery::mock('Eloquent', 'EventsVendorsMapping');
        App::instance('EventsVendorsMapping', $this->mapping);
    }

    private function prepareData()
    {
        $this->session(array('event_id' => 1));

        $vendor = new Vendor();
        $vendor->aka = 'aka1';
        $vendor->name = 'name';
        $vendor->surname = 'surname';
        $vendor->id_number = 'id_number';
        $vendor->save();

        $vendor = new Vendor();
        $vendor->aka = 'aka2';
        $vendor->name = 'name';
        $vendor->surname = 'surname';
        $vendor->id_number = 'id_number';
        $vendor->save();

        $eventsVendorsMapping = new EventsVendorsMapping();
        $eventsVendorsMapping->event_id = 1;
        $eventsVendorsMapping->vendor_id = 1;
        $eventsVendorsMapping->active = 'yes';
        $eventsVendorsMapping->save();
    }
}
