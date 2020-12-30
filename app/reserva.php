<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{
    protected $table = 'reserva';
    protected $fillable = [
        'id_user',
        'id_habitacion',
        'codigo',
        'nombre',
        'email',
        'fecha_reserva',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'adultos',
        'ninos',
        'descuento',
        'total',
        'estado'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function habitacion(){
        return $this->belongsTo('App\habitacion');
    }

    public function pago(){
        return $this->hasMany('App\reserva');
    }
}
