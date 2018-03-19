<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'categories', function( Blueprint $table ) {
			$table->increments( 'id' )->unsigned();
			//$table->foreign('id')->references('category_id')->on('cars');
			$table->string( 'name' );
			$table->string( 'logo' )->nullable();
			$table->boolean( 'default' )->default( 0 );
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
		Schema::dropIfExists( 'categories' );
	}
}
