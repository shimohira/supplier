<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePOTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PO', function(Blueprint $table)
		{
			$table->string('no_PO', 7);
			$table->date('tgl_PO');
			$table->string('no_SPPB', 7);
			$table->string('id_supp', 7);
			$table->String('ship_to', 255);
			$table->primary('no_PO');
			$table->foreign('no_SPPB')
					->references('no_SPPB')->on('SPPB')
					->onDelete('cascade');
			$table->foreign('id_supp')
					->references('id_supp')->on('supplier')
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
		Schema::drop('PO');
	}

}
