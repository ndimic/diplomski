<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'cars', function( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'category_id' )->unsigned();
			//$table->foreign('category_id')->references('id')->on('categories');
			$table->string( 'name' );
			$table->string( 'price' )->nullable();
			$table->integer( 'year' )->nullable();
			$table->integer( 'km' )->nullable();
			$table->string( 'image' )->nullable();
			$table->integer( 'status' )->default( 0 );
			$table->string( 'description' )->nullable();
			$table->integer( 'user_id' )->default( 1 );
			$table->timestamps();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists( 'cars' );
	}
}
