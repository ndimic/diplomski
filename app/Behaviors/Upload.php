<?php
/**
 * Created by PhpStorm.
 * User: ndimic
 * Date: 11.3.18.
 * Time: 18.26
 */

namespace App\Behaviors;

use Illuminate\Support\Facades\Storage;

trait Upload
{
	public function getImage()
	{
		return Storage::disk( config( 'uploads.disk' ) )->url( config( 'uploads.destination' ) . $this->image );
	}
	
	/**
	 * @param $file
	 * @param $name string
	 */
	private function upload( $file, $name )
	{
		$disk = config( 'uploads.disk' );
		
		$destination = config( 'uploads.destination' );
		
		Storage::disk( $disk )->putFileAs( $destination, $file, $name );
		
		return true;
	}
}