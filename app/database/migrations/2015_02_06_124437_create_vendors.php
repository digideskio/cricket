<?php

use Illuminate\Database\Migrations\Migration;

class CreateVendors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function($table)
		{
			$table->increments('id');
			$table->string('aka', 128);
			$table->string('name', 128);
			$table->string('surname', 128);
			$table->string('photo', 128);
			$table->bigInteger('id_number');
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
		Schema::drop('vendors');
	}

}
