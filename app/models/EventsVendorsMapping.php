<?php

class EventsVendorsMapping extends Base {
    protected $table = 'events_vendors_mappings';
    protected $fillable = array(
        'event_id',
        'vendor_id',
        'active',
    );
}
