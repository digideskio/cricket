<?php

class VendorsAddControllerTest extends TestCase
{
    private $model;

    public function setUp()
    {
        parent::setUp();

        $this->model = Mockery::mock('Eloquent', 'Vendor');
        App::instance('Vendor', $this->model);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testAddVendor_AddingFails_ReturnsFailureJSON()
    {
        $this->model->shouldReceive('create')->once()->andThrow(new DataFailureException());
        $returned = $this->call('POST', '/vendors/add');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }
}
