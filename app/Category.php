<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;

    public static $rules = [
        'name' => 'required'
    ];

    protected $table = 'categories';

    public function cars() {
        return $this->belongsTo(Car::class);
    }
}