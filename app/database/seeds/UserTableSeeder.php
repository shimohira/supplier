<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		
		DB::table('users')->insert(array(
			array(
				'nama' => 'Wahyu',
				'no_kar' => 'karB001',
				'username' => 'admin',
				'password' => Hash::make('admin')
				)
			)
		);
	}

}