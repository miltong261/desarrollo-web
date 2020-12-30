<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo_habitacion;
use Illuminate\Support\Facades\DB;

class tipohabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_habitacion = tipo_habitacion::join('promocion','promocion.id','=','tipo_habitacion.id_promocion')
        ->select('tipo_habitacion.id','tipo_habitacion.id_promocion',
        'promocion.nombre as nombre_promocion',
        'tipo_habitacion.nombre','tipo_habitacion.descripcion','tipo_habitacion.capacidad','tipo_habitacion.tarifa',
        'tipo_habitacion.estado')->get();
        return $tipo_habitacion;
    }

    public function selectTipoHabitacion(){
        $tipo_habitacion = tipo_habitacion::where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();
        return $tipo_habitacion;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:tipo_habitacion',
            'descripcion' => 'nullable|string|max:250',
            'capacidad' => 'required|integer',
            'tarifa' => 'required|numeric'
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'capacidad.required' => 'La capacidad de personas es obligatoria',
            'capacidad.integer' => 'Solo se aceptan números enteros',

            'tarifa.required' => 'La tarifa es obligatoria',
            'tarifa.numeric' => 'Solo se aceptan números'
        ]);

        try {
            DB::beginTransaction();
            $tipo_habitacion = new tipo_habitacion();
            $tipo_habitacion->id_promocion = $request->id_promocion;
            $tipo_habitacion->nombre = $request->nombre;
            $tipo_habitacion->descripcion = $request->descripcion;
            $tipo_habitacion->capacidad = $request->capacidad;
            $tipo_habitacion->tarifa = $request->tarifa;
            $tipo_habitacion->estado = '1';
            $tipo_habitacion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
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
        $this->validate($request,[
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:tipo_habitacion,nombre,'.$request->id,
            'descripcion' => 'nullable|string|max:250',
            'capacidad' => 'required|integer',
            'tarifa' => 'required|numeric'
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'capacidad.required' => 'La capacidad de personas es obligatorio',
            'capacidad.numeric' => 'Solo se aceptan números',

            'tarifa.required' => 'La tarifa es obligatoria',
            'tarfia.integer' => 'Solo se aceptan números enteros'
        ]);

        try {
            DB::beginTransaction();
            $tipo_habitacion = tipo_habitacion::findOrFail($request->id);
            $tipo_habitacion->id_promocion = $request->id_promocion;
            $tipo_habitacion->nombre = $request->nombre;
            $tipo_habitacion->descripcion = $request->descripcion;
            $tipo_habitacion->capacidad = $request->capacidad;
            $tipo_habitacion->tarifa = $request->tarifa;
            $tipo_habitacion->estado = '1';
            $tipo_habitacion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $tipo_habitacion = tipo_habitacion::findOrFail($request->id);
        $tipo_habitacion->estado = '1';
        $tipo_habitacion->save();
    }

    public function desactivate(Request $request){
        $tipo_habitacion = tipo_habitacion::findOrFail($request->id);
        $tipo_habitacion->estado = '0';
        $tipo_habitacion->save();
    }
}
