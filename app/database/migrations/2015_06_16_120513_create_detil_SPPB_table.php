<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetilSPPBTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detil_SPPB', function(Blueprint $table)
		{
			$table->string('no_SPPB', 7);
			$table->string('kode_barang', 7);
			$table->integer('jml_pesan');
			$table->string('ket', 255);
			$table->foreign('no_SPPB')
					->references('no_SPPB')->on('SPPB')
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
		Schema::drop('detil_SPPB');
	}

}
