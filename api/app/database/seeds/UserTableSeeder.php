<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
	    User::create(array(
	        'nome'     => 'Administrador',
	        'email'    => 'admin@rasador.com.br',
	        'password' => Hash::make('123'),
	    ));
	}

}