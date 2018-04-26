<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = true;
	
	public static $rules = [
		'name' => 'required',
		'logo' => 'required|file'
	];
	
	protected $table = 'categories';
	
	public function cars()
	{
		return $this->hasMany( Car::class );
	}
}