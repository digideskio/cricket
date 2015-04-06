<?php

class EventVendorItem extends Base {
    protected $table = 'event_vendor_item';
    protected $fillable = array(
        'event_id',
        'vendor_id',
        'item_id',
        'amount',
        'event_vendor_item_group_id',
        'active',
    );
}
