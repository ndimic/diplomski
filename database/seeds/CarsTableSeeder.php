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
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 1
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW Serie 3 340i (2015)',
			'price'       => 40000.00,
			'year'        => '2015',
			'km'          => '15000',
			'image'       => 'bmw_serie3.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 2
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 1,
			'name'        => 'BMW X4',
			'price'       => 37000.00,
			'year'        => '2016',
			'km'          => '25000',
			'image'       => 'bmw_x4.png',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 3
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi Q7',
			'price'       => 20000.00,
			'year'        => '2016',
			'km'          => '10000',
			'image'       => 'audi_q7.png',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 4
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi Q2 Sport',
			'price'       => 17500.00,
			'year'        => '2012',
			'km'          => '100000',
			'image'       => 'audi_q2_sport.png',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 5
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 2,
			'name'        => 'Audi A4 2.0 TDI S line',
			'price'       => 22000.00,
			'year'        => '2015',
			'km'          => '10000',
			'image'       => 'audi_a4.png',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 6
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes C Class',
			'price'       => 40000.00,
			'year'        => '2017',
			'km'          => '15000',
			'image'       => 'mercedes_c_class.png',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 3
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes Benz AMG GT',
			'price'       => 100000.00,
			'year'        => '2018',
			'km'          => '0',
			'image'       => 'mercedes_amg.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 5
		] );
		
		DB::table( 'cars' )->insert( [
			'category_id' => 3,
			'name'        => 'Mercedes-Benz S-Coupe',
			'price'       => 16000.00,
			'year'        => '2014',
			'km'          => '150000',
			'image'       => 'mercedes_s.jpg',
			'status'      => 1,
			'default'     => 1,
			'description' => '',
			'created_at'  => Carbon::now(),
			'updated_at'  => Carbon::now(),
			'user_id'     => 2
		] );
	}
}
