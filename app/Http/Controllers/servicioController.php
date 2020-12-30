<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicio;
use Illuminate\Support\Facades\DB;

class servicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicio = servicio::all();
        return $servicio;
    }

    public function listarServicio(){
        $servicio = servicio::where('estado','=','1')
        ->select('id','nombre','descripcion','precio')->orderBy('nombre','asc')->get();
        return $servicio;
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:servicio',
            'descripcion' => 'nullable|regex:/^[a-zA-Z\s]+$/u|max:250',
            'precio' => 'required|numeric'
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'descripcion.regex' => 'Solo se acepta caracteres alfabéticos',
            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'Solo se aceptan números'
        ]);

        try {
            DB::beginTransaction();
            $servicio = new servicio();
            $servicio->nombre = $request->nombre;
            $servicio->descripcion = $request->descripcion;
            $servicio->precio = $request->precio;
            $servicio->estado = '1';
            $servicio->save();
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:servicio,nombre,'.$request->id,
            'descripcion' => 'nullable|regex:/^[a-zA-Z\s]+$/u|max:250',
            'precio' => 'required|numeric'
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'descripcion.regex' => 'Solo se acepta caracteres alfabéticos',
            'descripcion.max' => 'Solo se acepta 250 caracteres',

            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'Solo se aceptan números'
        ]);

        try {
            DB::beginTransaction();
            $servicio = servicio::findOrFail($request->id);
            $servicio->nombre = $request->nombre;
            $servicio->descripcion = $request->descripcion;
            $servicio->precio = $request->precio;
            $servicio->estado = '1';
            $servicio->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $servicio = servicio::findOrFail($request->id);
        $servicio->estado = '1';
        $servicio->save();
    }

    public function desactivate(Request $request){
        $servicio = servicio::findOrFail($request->id);
        $servicio->estado = '0';
        $servicio->save();
    }
}
