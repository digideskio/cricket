<?php

class VendorsAssignedControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        $this->session(['event_id' => 1, 'message' => 'message']);
    }

    public function tearDown()
    {
        Session::forget('event_id');
    }

    public function testShowOverview_NoAssignedVendors_RedirectsToVendorAssign()
    {
        $this->prepareInvalidData();

        $this->call('GET', '/vendors/assigned');
        $this->assertRedirectedTo('/vendors/assign');
    }

    public function testShowOverview_AssignedVendors_ReturnsDataToView()
    {
        $this->prepareData();

        $returned = $this->call('GET', '/vendors/assigned');
        
        $data = $returned->getOriginalContent();
        $this->assertEquals('test vendor', $data['vendors'][0]['aka']);
        $this->assertViewHas('message');
    }

    private function prepareInvalidData()
    {
        $Vendor = new Vendor();
        $Vendor->aka = 'aka';
        $Vendor->save();

        $Events = new Events();
        $Events->description = 'description';
        $Events->save();

        $EventVendor = new EventVendor();
        $EventVendor->event_id = 1;
        $EventVendor->vendor_id = 1;
        $EventVendor->active = 'no';
        $EventVendor->save();
    }

    private function prepareData()
    {
        $vendor = new Vendor();
        $vendor->aka = 'test vendor';
        $vendor->save();

        $Events = new Events();
        $Events->description = 'description';
        $Events->save();

        $EventVendor = new EventVendor();
        $EventVendor->event_id = 1;
        $EventVendor->vendor_id = 1;
        $EventVendor->active = 'yes';
        $EventVendor->save();
    }
}
