<?php

class VendorsAddController extends BaseAddController
{
    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        return parent::add();
    }
}
