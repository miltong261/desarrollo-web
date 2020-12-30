<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rol;

class rolController extends Controller
{
    public function selectRol(){
        $rol = rol::where('estado','=','1')->where('nombre','!=','Guest')
        ->select('id','nombre')->orderBy('nombre','asc')->get();
        return $rol;
    }
}
