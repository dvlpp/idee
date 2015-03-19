<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uploads', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('fichier');
            $table->string('owner_type'); // type du owner = model. Ex : "Projet"
            $table->integer('owner_id')->unsigned()->index();
            $table->string('owner_key'); // key fonctionnelle pour qualifier la PJ côté owner (ex : "photos", ou "pdf_dl")
            $table->string('typemime');
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
		Schema::drop('uploads');
	}

}
