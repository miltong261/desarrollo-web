<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo_pago;
use Illuminate\Support\Facades\DB;

class tipopagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_pago = tipo_pago::all();
        return $tipo_pago;
    }

    public function selectTipoPago(){
        $tipo_pago = tipo_pago::where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();

        return $tipo_pago;
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:tipo_pago',
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',
        ]);

        try {
            DB::beginTransaction();
            $tipo_pago = new tipo_pago();
            $tipo_pago->nombre = $request->nombre;
            $tipo_pago->estado = '1';
            $tipo_pago->save();
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50|unique:tipo_pago,nombre,'.$request->id,
        ],[
            'nombre.unique' => 'Este nombre ya esta registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',
        ]);

        try {
            DB::beginTransaction();
            $tipo_pago = tipo_pago::findOrFail($request->id);
            $tipo_pago->nombre = $request->nombre;
            $tipo_pago->estado = '1';
            $tipo_pago->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $tipo_pago = tipo_pago::findOrFail($request->id);
        $tipo_pago->estado = '1';
        $tipo_pago->save();
    }

    public function desactivate(Request $request){
        $tipo_pago = tipo_pago::findOrFail($request->id);
        $tipo_pago->estado = '0';
        $tipo_pago->save();
    }
}
