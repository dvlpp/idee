<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIllustrableVisuelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('illustrable_visuels', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('legende')->nullable();
            $table->integer('ordre')->unsigned()->default(0);
            $table->integer('illustrable_id')->unsigned()->index();
            $table->string('illustrable_type');
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
		Schema::drop('illustrable_visuels');
	}

}
