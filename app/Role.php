<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';
	
	/**
	 * Fillable fields
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];
	
	/**
	 * Rules
	 *
	 * @var array
	 */
	public static $rules = [
		'name' => 'required|unique:roles'
	];
	
	/**
	 * A Roles users
	 *
	 * @return Relationship
	 */
	public function users()
	{
		return $this->belongsToMany( User::class );
	}
}