<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventVendorItemGroup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_vendor_item_group', function($table)
		{
			$table->increments('id');
			$table->enum('active', array('yes', 'no'))->default('yes');
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
		Schema::drop('event_vendor_item_group');
	}

}
