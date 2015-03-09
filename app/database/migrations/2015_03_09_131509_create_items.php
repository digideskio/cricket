<?php

use Illuminate\Database\Migrations\Migration;

class CreateItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function($table)
		{
			$table->increments('id');
			$table->string('description', 128);
			$table->enum('size', array('L', 'M', 'S'))->default('L');
			$table->integer('price');
			$table->integer('starting_amount')->default(0);
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
		Schema::drop('items');
	}

}
