<?php

class VendorsAssignControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
    }

    public function testShowVendors_NoVendors_RedirectsToVendorNew()
    {
        $returned = $this->call('GET', '/vendors/assign');
        $data = $returned->getOriginalContent();
        $this->assertEquals(array(), $data['vendors']);
    }

    public function testShowVendors_VendorsExist_ReturnsDataToView()
    {
        $this->prepareData();
        $this->assignVendor();

        $returned = $this->call('GET', '/vendors/assign');
        $data = $returned->getOriginalContent();

        $count = 0;
        foreach ($data['vendors'] as $vendor) {
            $this->assertEquals(2, $vendor['id']);
            $count++;
        }
        $this->assertEquals(1, $count);
    }

    public function testAssignVendor_AssignSuccess_AssignsVendor()
    {
        $this->prepareData();

        $returned = $this->call(
            'POST',
            '/vendors/assign',
            array(
                'vendor_id' => 1,
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }

    public function testAssignVendor_VendorAssigned_DoesNotDuplicate()
    {
        $this->prepareData();
        $this->assignVendor();

        $returned = $this->call(
            'POST',
            '/vendors/assign',
            array(
                'vendor_id' => 1,
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);

        $data = EventVendor::all();
        $this->assertEquals(1, $data->count());
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

        $event = new Events();
        $event->description = 'description';
        $event->save();
    }

    private function assignVendor()
    {
        $EventVendor = new EventVendor();
        $EventVendor->event_id = 1;
        $EventVendor->vendor_id = 1;
        $EventVendor->active = 'yes';
        $EventVendor->save();
    }
}
