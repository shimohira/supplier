<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('DepartmentTableSeeder');
		$this->call('BarangTableSeeder');
		$this->call('SupplierTableSeeder');
		$this->call('UserTableSeeder');
	}

}
