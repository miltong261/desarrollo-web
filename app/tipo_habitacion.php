<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_habitacion extends Model
{
    protected $table = 'tipo_habitacion';
    protected $fillable = ['id_promocion','id_servicio','nombre','descripcion','capacidad','tarifa','estado'];

    public function promocion(){
        return $this->belongsTo('App\promocion');
    }

    public function habitacion(){
        return $this->hasMany('App\habitacion');
    }
}
