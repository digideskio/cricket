<?php

class VendorsAddControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
    }

    public function testAddVendor_AddingFails_ReturnsFailureJSON()
    {
        $returned = $this->call('POST', '/vendors/new', array('name' => 'name'));
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddVendor_AddingSuccess_ReturnsVendor()
    {
        $returned = $this->call(
            'POST',
            '/vendors/new',
            array(
                'aka' => 'aka1',
                'name' => 'name',
                'surname' => 'surname',
                'id_number' => 'id_number',
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }

    public function testAddVendor_DuplicateExists_ReturnsFailureJSON()
    {
        $vendor = new Vendor();
        $vendor->aka = 'aka1';
        $vendor->name = 'name';
        $vendor->surname = 'surname';
        $vendor->id_number = 'id_number';
        $vendor->save();

        $returned = $this->call(
            'POST',
            '/vendors/new',
            array('aka' => 'aka1')
        );
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }
}
