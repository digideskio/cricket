<?php

use Illuminate\Support\Facades\Response;

class EventsAddController extends BaseController
{
    private $events;

    public function __construct(Events $model)
    {
        $this->events = $model;
    }

    public function add()
    {
        try {
            $id = $this->addEvent();
            Session::put('event_id', $id);
        } catch (DataFailureException $e) {
            return Response::json(array('success' => 'no'), 200);
        }
        return Response::json(array('success' => 'yes'), 200);
    }

    private function addEvent()
    {
        $name = Input::get('description', 'default');
        $model = $this->events->create(array('description' => $name));
        return $model->id;
    }
}
