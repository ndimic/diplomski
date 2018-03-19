<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Behaviors\Upload;

class Car extends Model
{
	use Upload;
	
	public $timestamps = true;
	
	protected $fillable = [
		'category_id',
		'name',
		'price',
		'year',
		'km',
		'image',
		'description',
		'user_id'
	];
	
	protected $table = 'cars';
	
	public function category()
	{
		return $this->belongsTo( Category::class );
	}
	
	public function user()
	{
		return $this->belongsTo( User::class );
	}
}