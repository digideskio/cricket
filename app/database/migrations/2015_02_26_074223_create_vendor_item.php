<?php

use Illuminate\Database\Migrations\Migration;

class CreateVendorItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendor_item', function($table)
		{
			$table->increments('id');
			$table->unsignedInteger('vendor_id');
			$table->foreign('vendor_id')->references('id')->on('vendors');
			$table->unsignedInteger('item_id');
			$table->foreign('item_id')->references('id')->on('items');
			$table->unsignedInteger('event_id');
			$table->foreign('event_id')->references('id')->on('events');
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
		Schema::drop('vendor_item');
	}

}
