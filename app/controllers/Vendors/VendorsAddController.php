<?php

use Illuminate\Support\Facades\Response;

class VendorsAddController extends BaseController
{
    private $model;

    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        try {
            $vendor = $this->addVendor();
        } catch (DataFailureException $e) {
            return Response::json(array('success' => 'no'), 200);
        }
        return Response::json(array('success' => 'yes', 'vendor' => $vendor), 200);
    }

    private function addVendor()
    {
        $aka = Input::get('aka');
        $name = Input::get('name');
        $surname = Input::get('surname');
        $id_number = Input::get('id_number');

        return $this->model->create(
            array(
                'aka' => $aka,
                'name' => $name,
                'surname' => $surname,
                'id_number' => $id_number,
            )
        );
    }
}
