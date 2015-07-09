<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class SupplierTableSeeder extends Seeder {

	public function run()
	{
		DB::table('supplier')->delete();
		
		DB::table('supplier')->insert(array(
			array(
				'id_supp' => 'SP001',
				'nm_supp' => 'Supplier 1',
				'alamat' => 'jalan jalan',
				'telp' => '085608560856',
				'fax' => '021021021',
				),
			array(
				'id_supp' => 'SP002',
				'nm_supp' => 'Supplier 2',
				'alamat' => 'jalan jalan',
				'telp' => '085608560856',
				'fax' => '021021021',
				),
			array(
				'id_supp' => 'SP003',
				'nm_supp' => 'Supplier 3',
				'alamat' => 'jalan jalan',
				'telp' => '085608560856',
				'fax' => '021021021',
				),
			)
		);
	}

}