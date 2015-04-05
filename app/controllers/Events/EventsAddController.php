<?php

class EventsAddController extends BaseAddController
{
    public function __construct(Events $model)
    {
        $this->model = $model;
    }

    public function add()
    {
        if ($this->model->save() === false) {
            return Response::json(
                array('success' => 'no', 'message' => $this->model->errorString()),
                200
            );
        }
        Session::put('event_id', $this->model->id);
        return Response::json(array('success' => 'yes', 'model' => $this->model), 200);
    }
}
