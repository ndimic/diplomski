<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'phone'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];
	
	/**
	 * User Roles
	 *
	 * @return Relationship
	 */
	public function roles()
	{
		return $this->belongsToMany( Role::class, 'users_roles' );
	}
	
	public function hasRole( $role )
	{
		$roles = array_column( $this->roles->toArray(), 'name' );
		
		return array_search( $role, $roles ) > -1;
	}
	
	public function cars()
	{
		return $this->hasMany( Car::class );
	}
}
