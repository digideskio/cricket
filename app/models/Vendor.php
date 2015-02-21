<?php

class Vendor extends Base {
    protected $table = 'vendors';
    protected $fillable = array(
        'aka',
        'name',
        'surname',
        'photo',
        'id_number',
    );

    public static $rules = array(
        'aka' => 'required|between:2,16',
    );
}
