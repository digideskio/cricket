<?php

class BaseAddController extends BaseController
{
    protected $model;

    public function add()
    {
        if ($this->model->save() === false) {
            return Response::json(
                array('success' => 'no', 'message' => $this->model->errorString()),
                200
            );
        }
        return Response::json(array('success' => 'yes', 'model' => $this->model), 200);
    }
}
