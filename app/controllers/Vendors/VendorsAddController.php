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
            $this->addVendor();
        } catch (DataSaveException $e) {
            return Response::json(
                array('success' => 'no', 'message' => $e->getMessage()),
                200
            );
        }
        return Response::json(array('success' => 'yes', 'vendor' => $this->model), 200);
    }

    private function addVendor()
    {
        $this->model->aka = Input::get('aka');
        $this->model->name = Input::get('name');
        $this->model->aka = Input::get('surname');
        $this->model->aka = Input::get('id_number');

        if ($this->model->save() === false) {
            throw new DataSaveException($this->model->errors()->all());
        }
    }
}
