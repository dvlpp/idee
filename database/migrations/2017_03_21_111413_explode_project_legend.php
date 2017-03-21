<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExplodeProjectLegend extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('illustrable_visuels', function(Blueprint $table)
		{
            $table->string('objet')->nullable();
            $table->string('designer')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('illustrable_visuels', function(Blueprint $table)
		{
            $table->dropColumn('objet');
            $table->dropColumn('designer');
		});
	}

}
