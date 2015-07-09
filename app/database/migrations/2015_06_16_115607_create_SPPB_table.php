<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSPPBTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SPPB', function(Blueprint $table)
		{
			$table->string('no_SPPB',7);
			$table->date('tgl_SPPB');
			$table->string('id_dept', 7);
			$table->string('no_kar', 7);
			$table->primary('no_SPPB');
			$table->foreign('id_dept')
					->references('id_dept')->on('department')
					->onDelete('cascade');
			$table->foreign('no_kar')
					->references('no_kar')->on('users')
					->onDelete('cascade');
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
		Schema::drop('SPPB');
	}

}
