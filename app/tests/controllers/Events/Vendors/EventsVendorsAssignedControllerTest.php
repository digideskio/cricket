<?php

class EventsVendorsAssignedControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->session(['event_id' => 1, 'message' => 'message']);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        Session::forget('event_id');
    }

    public function testShowOverview_NoAssignedVendors_RedirectsToVendorAssign()
    {
        $this->prepareInvalidData();

        $this->call('GET', '/events/vendors/assigned');
        $this->assertRedirectedTo('/events/vendors/assign');
    }

    public function testShowOverview_AssignedVendors_ReturnsDataToView()
    {
        $this->prepareData();

        $returned = $this->call('GET', '/events/vendors/assigned');
        
        $data = $returned->getOriginalContent();
        $this->assertEquals('test vendor', $data['vendors'][0]['aka']);
        $this->assertViewHas('message');
    }

    private function prepareInvalidData()
    {
        $eventsVendorsMapping = new EventsVendorsMapping();
        $eventsVendorsMapping->event_id = 1;
        $eventsVendorsMapping->vendor_id = 1;
        $eventsVendorsMapping->active = 'no';
        $eventsVendorsMapping->save();

        $eventsVendorsMapping = new EventsVendorsMapping();
        $eventsVendorsMapping->event_id = 2;
        $eventsVendorsMapping->vendor_id = 1;
        $eventsVendorsMapping->active = 'yes';
        $eventsVendorsMapping->save();
    }

    private function prepareData()
    {
        $vendor = new Vendor();
        $vendor->aka = 'test vendor';
        $vendor->save();

        $eventsVendorsMapping = new EventsVendorsMapping();
        $eventsVendorsMapping->event_id = 1;
        $eventsVendorsMapping->vendor_id = 1;
        $eventsVendorsMapping->active = 'yes';
        $eventsVendorsMapping->save();
    }
}
