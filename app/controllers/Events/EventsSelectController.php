<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventsSelectController extends BaseController
{
    private $events;

    public function __construct(Events $model)
    {
        $this->events = $model;
    }

    public function showOverview()
    {
        try {
            $events = $this->events->all();
        } catch (ModelNotFoundException $e) {
            return Redirect::to('/events/new')->with('message', 'Please create a new event');
        }
        return View::make('Events/select', $this->getMesssageArray(array('events' => $events)));
    }

    public function assignSelected()
    {
        try {
            $events = $this->events->findOrFail(Input::get('event_id'));
            Session::put('event_id', $events->id);
        } catch (ModelNotFoundException $e) {
            return Response::json(array('success' => 'no'), 200);
        }
        return Response::json(array('success' => 'yes'), 200);
    }
}
