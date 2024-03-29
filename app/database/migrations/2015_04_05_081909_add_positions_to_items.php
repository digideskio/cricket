<?php

use Illuminate\Database\Migrations\Migration;

class AddPositionsToItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items', function($table)
        {
            $table->integer('position');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('items', function($table)
        {
            $table->dropColumn('position');
        });
	}

}
