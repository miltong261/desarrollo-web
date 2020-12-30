<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class habitacion extends Model
{
    protected $table = 'habitacion';
    protected $fillable = ['id_tipo_habitacion','no_habitacion','observacion','checkin','checkout','estado'];

    public function tipo_habitacion(){
        return $this->belongsTo('App\tipo_habitacion');
    }

    public function reserva(){
        return $this->hasMany('App\reserva');
    }
}
