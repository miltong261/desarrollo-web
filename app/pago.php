<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    protected $table = 'pago';
    protected $fillable = ['id_reserva','concepto','monto','pendiente','estado'];

    public $timestamps = false;

    public function tipo_pago(){
        return $this->belongsTo('App\tipo_pago');
    }

    public function reserva(){
        return $this->belongsTo('App\reserva');
    }
}
