<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsExpiredToCarsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table( 'cars', function( Blueprint $table ) {
			
			$table->boolean( 'is_expired' )->default( 0 );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table( 'cars', function( Blueprint $table ) {
			
			$table->dropColumn( 'is_expired' );
		} );
	}
}
