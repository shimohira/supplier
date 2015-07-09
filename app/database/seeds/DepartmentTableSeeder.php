<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class DepartmentTableSeeder extends Seeder {

	public function run()
	{
		DB::table('department')->delete();
		
		DB::table('department')->insert(array(
			array(
				'id_dept' => 'DP001',
				'nm_dept' => 'Department 1'
				),
			array(
				'id_dept' => 'DP002',
				'nm_dept' => 'Department 2'
				),
			array(
				'id_dept' => 'DP003',
				'nm_dept' => 'Department 3'
				)
			)
		);
	}

}