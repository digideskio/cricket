<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventVendor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_vendor', function($table)
		{
			$table->increments('id');
			$table->unsignedInteger('event_id');
			$table->foreign('event_id')->references('id')->on('events');
			$table->unsignedInteger('vendor_id');
			$table->foreign('vendor_id')->references('id')->on('vendors');
			$table->enum('active', array('yes', 'no'))->default('yes');
			$table->unique('event_id', 'vendor_id');
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
		Schema::drop('event_vendor');
	}
}
