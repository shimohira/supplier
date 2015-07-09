<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice', function(Blueprint $table)
		{
			$table->string('no_inv', 7);
			$table->date('tgl_inv');
			$table->string('ship_by', 255);
			$table->string('pay_method', 10);
			$table->string('no_rek', 10);
			$table->string('pelabuhan', 50);
			$table->string('carrier', 50);
			$table->string('no_PO', 7);
			$table->primary('no_inv');
			$table->foreign('no_PO')
					->references('no_PO')->on('PO')
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
		Schema::drop('invoice');
	}

}
