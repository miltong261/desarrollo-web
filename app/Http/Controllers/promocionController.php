<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\promocion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class promocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocion = promocion::all();
        return $promocion;
    }

    public function selectPromocion(){
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $promocion = promocion::where('fecha_inicio','<=',$date)
        ->where('fecha_fin','>=',$date)->where('estado','=','1')->orWhere('estado','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();
        return $promocion;
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:promocion',
            'descripcion' => 'nullable|string|max:250',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'porcentaje' => 'required|numeric'
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',
            'nombre.unique' => 'El nombre ya esta registrado',

            'descripcion.regex' => 'Solo se acepta caracteres alfabéticos',
            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'fecha_inicio.required' => 'La fecha es obligatoria',
            'fecha_inicio.date' => 'Solo se acepta formato fecha',

            'fecha_fin.required' => 'La fecha es obligatoria',
            'fecha_fin.date' => 'Solo se acepta formato fecha',
            
            'porcentaje.required' => 'El porcentaje es obligatorio',
            'porcentaje.numeric' => 'Solo se aceptan números'    
        ]);
        
        try {
            DB::beginTransaction();
            $promocion = new promocion();
            $promocion->nombre = $request->nombre;
            $promocion->descripcion = $request->descripcion;
            $promocion->fecha_inicio = $request->fecha_inicio;
            $promocion->fecha_fin = $request->fecha_fin;
            $promocion->porcentaje = $request->porcentaje;
            $promocion->estado = '1';
            $promocion->save();
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:promocion,nombre,'.$request->id,
            'descripcion' => 'nullable|regex:/^[a-zA-Z\s]+$/u|max:250',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'porcentaje' => 'required|numeric'
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',
            'nombre.unique' => 'El nombre ya esta registrado',

            'descripcion.regex' => 'Solo se acepta caracteres alfabéticos',
            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'fecha_inicio.required' => 'La fecha es obligatoria',
            'fecha_inicio.date' => 'Solo se acepta formato fecha',

            'fecha_fin.required' => 'La fecha es obligatoria',
            'fecha_fin.date' => 'Solo se acepta formato fecha',
            
            'porcentaje.required' => 'El porcentaje es obligatorio',
            'porcentaje.numeric' => 'Solo se aceptan números'    
        ]);

        try {
            DB::beginTransaction();
            $promocion = promocion::findOrFail($request->id);
            $promocion->nombre = $request->nombre;
            $promocion->descripcion = $request->descripcion;
            $promocion->fecha_inicio = $request->fecha_inicio;
            $promocion->fecha_fin = $request->fecha_fin;
            $promocion->porcentaje = $request->porcentaje;
            $promocion->estado = '1';
            $promocion->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $promocion = promocion::findOrFail($request->id);
        $promocion->estado = '1';
        $promocion->save();
    }

    public function desactivate(Request $request){
        $promocion = promocion::findOrFail($request->id);
        $promocion->estado = '0';
        $promocion->save();
    }
}
