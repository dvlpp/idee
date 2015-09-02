<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartenairesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partenaires', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('projet_id')->unsigned()->index();
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->string('nom');
            $table->string('url')->nullable();
            $table->tinyInteger('ordre')->unsigned()->default(0);
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
		Schema::drop('partenaires');
	}

}
