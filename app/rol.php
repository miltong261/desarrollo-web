<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    protected $table = 'rol';
    protected $fillable = ['nombre','estado'];

    public $timestamps = false;

    public function users(){
        return $this->hasMany('App\User');
    }
}
