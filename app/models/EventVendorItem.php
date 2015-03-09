<?php

class EventVendorItem extends Base {
    protected $table = 'event_vendor_item';
    protected $fillable = array(
        'vendor_id',
        'item_id',
        'active',
    );
}
