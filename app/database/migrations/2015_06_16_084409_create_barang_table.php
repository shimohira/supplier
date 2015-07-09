<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barang', function(Blueprint $table)
		{
			$table->string('kode_barang', 7);
			$table->string('nm_barang', 100);
			$table->string('satuan', 12);
			$table->string('brand', 20);
			$table->bigInteger('hrg_satuan');
			$table->integer('jml_barang');
			$table->primary('kode_barang');
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
		Schema::drop('barang');
	}

}
