<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDOTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('DO', function(Blueprint $table)
		{
			$table->string('no_DO');
			$table->date('tgl_DO');
			$table->string('no_inv');
			$table->primary('no_DO');
			$table->foreign('no_inv')
					->references('no_inv')->on('invoice')
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
		Schema::drop('DO');
	}

}
