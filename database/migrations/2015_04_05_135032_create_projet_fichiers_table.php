<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetFichiersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projet_fichiers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('titre');
            $table->integer('ordre')->unsigned()->default(0);
            $table->integer('projet_id')->unsigned()->index();
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
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
        Schema::drop('projet_fichiers');
	}

}
