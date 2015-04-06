<?php

use Illuminate\Database\Migrations\Migration;

class AddEventVendorItemGroupIdToEventVendorItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_vendor_item', function($table)
        {
            $table->integer('event_vendor_item_group_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_vendor_item', function($table)
        {
            $table->dropColumn('event_vendor_item_group_id');
        });
	}

}
