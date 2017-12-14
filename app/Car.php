<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $timestamps = true;

    protected $table = 'cars';

    /*public function categories() {
        return $this->hasOne(Category::class);
    }*/

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}