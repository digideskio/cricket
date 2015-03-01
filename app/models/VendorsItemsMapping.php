<?php

class VendorsItemsMapping extends Base {
    protected $table = 'vendors_items_mappings';
    protected $fillable = array(
        'vendor_id',
        'item_id',
        'active',
    );
}
