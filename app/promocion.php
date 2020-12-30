<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class promocion extends Model
{
    protected $table = 'promocion';
    protected $fillable = ['nombre','descripcion','fecha_inicio','fecha_fin','porcentaje','estado'];

    public function tipo_habitacion(){
        return $this->hasMany('App\tipo_habitacion');
    }
}
