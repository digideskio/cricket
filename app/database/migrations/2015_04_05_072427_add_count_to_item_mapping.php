<?php

use Illuminate\Database\Migrations\Migration;

class AddCountToItemMapping extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_vendor_item', function($table)
        {
            $table->integer('amount');
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
            $table->dropColumn('amount');
        });
	}

}
