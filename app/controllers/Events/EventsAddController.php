<?php

class EventsAddController extends BaseAddController
{
    public function __construct(Events $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        return parent::add();
    }
}
