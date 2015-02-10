<?php

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
        } catch (NoDataException $e) {
            return Redirect::to('/events/new');
        }
        return View::make('Events/select', array('events' => $events));
    }

    public function assignSelected()
    {
        try {
            $events = $this->events->findOrFail(Input::get('event_id'));
            Session::put('event_id', $events->event_id);
        } catch (NoDataException $e) {
            return Response::json(array('success' => 'no'), 200);
        }
        return Redirect::to('/events/vendors/assigned');
    }
}
