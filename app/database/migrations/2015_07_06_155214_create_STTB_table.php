<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSTTBTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('STTB', function(Blueprint $table)
		{
			$table->string('no_STTB',7);
			$table->date('tgl_STTB');
			$table->string('no_kar', 7);
			$table->string('id_supp', 7);
			$table->primary('no_STTB');
			$table->foreign('id_supp')
					->references('id_supp')->on('supplier')
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
		Schema::drop('STTB');
	}

}
