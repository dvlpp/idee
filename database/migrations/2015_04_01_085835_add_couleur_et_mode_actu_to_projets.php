<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCouleurEtModeActuToProjets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projets', function(Blueprint $table)
		{
            $table->string("couleur")->nullable();
            $table->boolean("is_mode_actu")->default(0);
            $table->text("texte_actu")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projets', function(Blueprint $table)
		{
			$table->removeColumn("couleur");
            $table->removeColumn("is_mode_actu");
            $table->removeColumn("texte_actu");
		});
	}

}
