<?php

class Events extends Base {
    protected $table = 'events';
    protected $fillable = array('description');
    public static $rules = array(
        'description' => 'required',
    );
    public $autoHydrateEntityFromInput = true;
}
