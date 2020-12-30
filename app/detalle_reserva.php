<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detalle_reserva extends Model
{
    protected $table = 'detalle_reserva';
    protected $fillable = [
        'id_reserva',
        'id_servicio',
        'id_habitacion',
        'cantidad',
        'precio'
    ];

    public $timestamps = false;
}
