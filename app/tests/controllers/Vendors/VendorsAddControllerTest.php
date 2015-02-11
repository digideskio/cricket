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
        $returned = $this->call('POST', '/vendors/add', array('aka' => 'aka'));
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddVendor_ValidationFails_ReturnsFailureJSON()
    {
        $returned = $this->call('POST', '/vendors/add');
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddVendor_AddingSuccess_ReturnsVendor()
    {
        $expected = array(
            'aka' => 'aka',
            'name' => 'name',
            'surname' => 'surname',
            'id_number' => 'id_number',
        );
        $event = new stdClass();
        $event->id = 1;
        $this->model->shouldReceive('create')->once()->with($expected)->andReturn($event);
        $returned = $this->call(
            'POST',
            '/vendors/add',
            array(
                'aka' => 'aka',
                'name' => 'name',
                'surname' => 'surname',
                'id_number' => 'id_number',
            )
        );
        $data = $returned->getData(true);
        $this->assertEquals('yes', $data['success']);
    }
}
