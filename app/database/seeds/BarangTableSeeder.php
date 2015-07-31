<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class BarangTableSeeder extends Seeder {

	public function run()
	{
		DB::table('barang')->delete();
		for ($i=1;$i<10;$i++){
			DB::table('barang')->insert(array(
				array(
					'kode_barang' => 'BR00'.+$i,
					'nm_barang' => 'barang'.+$i,
					'part_number' => 'part'.+$i,
					'satuan' => 'satuan'.+$i,
					'brand' => 'brand'.+$i,
					'hrg_satuan' => rand(5,30)*1000,
					'jml_barang' => rand(10, 70)
					)
				)
			);
		}

		for ($i=10;$i<100;$i++){
			DB::table('barang')->insert(array(
				array(
					'kode_barang' => 'BR0'.+$i,
					'nm_barang' => 'barang'.+$i,
					'part_number' => 'part'.+$i,
					'satuan' => 'satuan'.+$i,
					'brand' => 'brand'.+$i,
					'hrg_satuan' => rand(5,30)*1000,
					'jml_barang' => rand(10, 70)
					)
				)
			);
		}
		
	}

}