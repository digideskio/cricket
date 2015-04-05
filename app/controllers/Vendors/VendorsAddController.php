<?php

class VendorsAddController extends BaseAddController
{
    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        try {
            $this->checkUnique();
        } catch (DataSaveException $e) {
            return Response::json(
                array('success' => 'no', 'message' => $e->getMessage()),
                200
            );
        }
        return parent::add();
    }

    private function checkUnique()
    {
        $existing = Vendor::where('aka', '=', Input::get('aka'));
        if ($existing->count() > 0) {
            throw new DataSaveException(array('Vendor AKA already exists'));
        }
    }
}
