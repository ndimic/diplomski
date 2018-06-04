<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table( 'users' )->insert( [
			'name'       => 'Nenad Dimic',
			'email'      => 'nenad.dimic34@gmail.com',
			'password'   => bcrypt( 'admin123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'Marko Markovic',
			'email'      => 'marko.markovic@test.com',
			'password'   => bcrypt( 'test123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'Petar Petrovic',
			'email'      => 'petar.petrovic@test.com',
			'password'   => bcrypt( 'test123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'Milos Djurdjevic',
			'email'      => 'milos.djurdjevic@test.com',
			'password'   => bcrypt( 'test123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'Nikola Nikolic',
			'email'      => 'nikola.nikolic@test.com',
			'password'   => bcrypt( 'test123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'Jovan Jovanovic',
			'email'      => 'jovan.jovanovic@test.com',
			'password'   => bcrypt( 'test123' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
	}
}
