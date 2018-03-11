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
			'name'       => 'admin',
			'email'      => 'admin@admin.com',
			'password'   => bcrypt( 'admin' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
		
		DB::table( 'users' )->insert( [
			'name'       => 'member',
			'email'      => 'member@member.com',
			'password'   => bcrypt( 'member' ),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		] );
	}
}
