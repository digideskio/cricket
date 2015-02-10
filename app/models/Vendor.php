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
}
