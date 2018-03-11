<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW X3',
			'price'       => 30000.00,
			'year'        => '2015',
			'km'          => '20000',
			'image'       => 'bmw_x3.jpg',
			'status'      => 1,
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now()
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi Q7',
			'price'       => 20000.00,
			'year'        => '2016',
			'km'          => '10000',
			'image'       => 'audi_q7.png',
			'status'      => 1,
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now()
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes C Class',
			'price'       => 40000.00,
			'year'        => '2017',
			'km'          => '15000',
			'image'       => 'mercedes_c_class.png',
			'status'      => 1,
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now()
		] );
	}
}
