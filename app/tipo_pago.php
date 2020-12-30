<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_pago extends Model
{
    protected $table = 'tipo_pago';
    protected $fillabe = ['nombre','estado'];

    public function pago(){
        return $this->hasMany('App\pago');
    }
}
