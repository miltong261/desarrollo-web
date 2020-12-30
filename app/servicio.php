<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $table = 'servicio';
    protected $fillable = ['nombre','descripcion','precio','estado'];

    /*public function tipo_habitaciones(){
        return $this->hasMany('App\tipo_habitacion');
    }*/
}
