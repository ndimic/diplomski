<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Car;

class AdExpired extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'ad:expired';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Checking if ad expired';
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$cars = Car::whereDefault( 0 )->whereIsExpired( 0 )->whereStatus( 1 )->get();
		
		if ( count( $cars ) ) {
			
			foreach ( $cars as $car ) {
				
				if ( $car->created_at->diffInMinutes() > config( 'car.expires.minutes' ) ) {
					
					$car->update( [
						
						'status'     => 0,
						'is_expired' => 1
					] );
				}
			}
		}
	}
}
