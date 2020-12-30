<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::join('rol','rol.id','=','users.id_rol')
        ->select('users.id','users.id_rol',
        'rol.nombre as nombre_rol',
        'users.name','users.email','users.estado')->get();
        return $User;
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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ],[
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'Solo se acepta 50 caracteres',

            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Campo de tipo email',
            'email.unique' => 'El correo ya existe',
            
            'password.required' => 'La contraseña es obligatoria'
        ]);
        
        try {
            DB::beginTransaction();
            $User = new User();
            $User->id_rol = $request->id_rol;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->estado = '1';
            $User->save();

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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'required'
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Campo de tipo email',
            'email.unique' => 'El correo ya existe',
            
            'password.required' => 'La contraseña es obligatoria'
        ]);
        
        try {
            DB::beginTransaction();
            $User = User::findOrFail($request->id);
            $User->id_rol = $request->id_rol;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->estado = '1';
            $User->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function activate(Request $request){
        $User = User::findOrFail($request->id);
        $User->estado = '1';
        $User->save();
    }

    public function desactivate(Request $request){
        $User = User::findOrFail($request->id);
        $User->estado = '0';
        $User->save();
    }
}
