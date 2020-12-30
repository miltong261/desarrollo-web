<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\habitacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class habitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitacion = habitacion::join('tipo_habitacion','tipo_habitacion.id','=','habitacion.id_tipo_habitacion')
        ->select('habitacion.id','habitacion.id_tipo_habitacion',
        'habitacion.no_habitacion','habitacion.observacion','tipo_habitacion.nombre as nombre_tipo_habitacion',
        'habitacion.estado','habitacion.habilitado')->get();
        return $habitacion;
    }

    public function listarHabitacion(){
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $habitacion = habitacion::join('tipo_habitacion','tipo_habitacion.id','=','habitacion.id_tipo_habitacion')
        ->join('promocion','promocion.id','=','tipo_habitacion.id_promocion')
        ->where('promocion.fecha_inicio','<=',$date)
        ->where('promocion.fecha_fin','>=',$date)->where('habitacion.estado','=','disponible')->where('promocion.estado','=','1')->orWhere('promocion.id','=','2')
        ->select('habitacion.id','habitacion.no_habitacion','habitacion.observacion','tipo_habitacion.nombre as nombre_tipo_habitacion',
        'tipo_habitacion.descripcion as descripcion_tipo_habitacion','tipo_habitacion.capacidad',
        'promocion.fecha_inicio as i','promocion.fecha_fin as f','tipo_habitacion.tarifa','promocion.porcentaje')->get();
        return $habitacion;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $habitacion = new habitacion();
            $habitacion->id_tipo_habitacion = $request->id_tipo_habitacion;
            $habitacion->no_habitacion = '#' . $this->numeroHabitacion();
            $habitacion->estado = 'Disponible';
            $habitacion->habilitado = '1';
            $habitacion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    private function numeroHabitacion(){
        $numero = habitacion::count();
        $numero++;

        return $numero;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $habitacion = habitacion::findOrFail($request->id);
            $habitacion->id_tipo_habitacion = $request->id_tipo_habitacion;
            $habitacion->observacion = $request->observacion;
            $habitacion->estado = 'Disponible';
            $habitacion->habilitado = '1';
            $habitacion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $habitacion = habitacion::findOrFail($request->id);
        $habitacion->estado = 'Disponible';
        $habitacion->habilitado = '1';
        $habitacion->save();
    }

    public function desactivate(Request $request){
        $habitacion = habitacion::findOrFail($request->id);
        $habitacion->estado = 'No disponible';
        $habitacion->habilitado = '0';
        $habitacion->save();
    }

    public function available(Request $request){
        $habitacion = habitacion::findOrFail($request->id);
        $habitacion->estado = 'Disponible';
        $habitacion->habilitado = '1';
        $habitacion->save();
    }
}
