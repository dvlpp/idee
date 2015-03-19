<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contenus', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("titre");
            $table->text("chapo");
            $table->text("texte");
            $table->boolean("en_ligne")->default(false);
            $table->tinyInteger("ordre")->unsigned()->default(0);
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
		Schema::drop('contenus');
	}

}
