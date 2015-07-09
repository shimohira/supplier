<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilSTTBTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_STTB', function(Blueprint $table)
		{
			$table->string('no_STTB', 7);
			$table->string('kode_barang', 7);
			$table->integer('jml_beli');
			$table->string('ket', 255);
			$table->foreign('no_STTB')
					->references('no_STTB')->on('STTB')
					->onDelete('cascade');
			$table->foreign('kode_barang')
					->references('kode_barang')->on('barang')
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
		Schema::drop('detil_STTB');
	}

}
