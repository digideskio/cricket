<?php

class Item extends Base {
    protected $table = 'items';
    protected $fillable = array(
        'description',
        'size',
        'price',
        'starting_amount',
        'active',
    );

    public static $rules = array(
        'description' => 'required',
        'price' => 'required|integer',
        'starting_amount' => 'integer',
    );
}
