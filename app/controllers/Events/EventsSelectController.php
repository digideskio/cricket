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
}
