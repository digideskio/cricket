<?php

class EventVendor extends Base {
    protected $table = 'event_vendor';
    protected $fillable = array(
        'event_id',
        'vendor_id',
        'active',
    );
}
