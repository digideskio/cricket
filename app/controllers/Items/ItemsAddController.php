<?php

class ItemsAddController extends BaseAddController
{
    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        return parent::add();
    }
}
