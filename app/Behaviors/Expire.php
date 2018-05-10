<?php
/**
 * Created by PhpStorm.
 * User: ndimic
 * Date: 11.5.18.
 * Time: 00.11
 */

namespace App\Behaviors;

use App\Car;

trait Expire
{
	public function expiredAds()
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