<?php

class VendorsAddControllerTest extends TestCase
{
    private $model;

    public function setUp()
    {
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        Mockery::close();
    }

    public function testAddVendor_AddingFails_ReturnsFailureJSON()
    {
        $mock = Mockery::mock('Vendor');
        App::instance('Vendor', $mock);

        $errors = Mockery::mock('Illuminate\Support\MessageBag');
        $errors->shouldReceive('all')->once()->andReturn(array('foo' => 'bar'));

        $mock->shouldReceive('setAttribute')->times(4)->andReturn(false);
        $mock->shouldReceive('save')->once()->andReturn(false);
        $mock->shouldReceive('errors')->andReturn($errors);

        $returned = $this->call('POST', '/vendors/add', array('aka' => 'aka'));
        $data = $returned->getData(true);
        $this->assertEquals('no', $data['success']);
    }

    public function testAddVendor_AddingSuccess_ReturnsVendor()
    {
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
