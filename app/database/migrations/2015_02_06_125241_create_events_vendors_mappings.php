<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventsVendorsMappings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_vendors_mappings', function($table)
		{
			$table->increments('id');
			$table->string('event_id', 128);
			$table->string('vendor_id', 128);
			$allow = array('yes', 'no');
			$table->enum('active', $allow)->default('yes');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events_vendors_mappings');
	}
}
