<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\reserva;
use App\detalle_reserva;
use App\habitacion;

class reservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/main');
        
        $reserva = reserva::join('users','users.id','=','reserva.id_user')
        ->join('habitacion','habitacion.id','=','reserva.id_habitacion')
        ->select('reserva.id','reserva.codigo','reserva.nombre','reserva.email','reserva.fecha_reserva',
        'reserva.fecha_inicio','reserva.fecha_fin','reserva.dias','reserva.descuento',
        'reserva.total','reserva.estado','habitacion.no_habitacion',
        'users.name')->get();
        return $reserva;
        
        /* Función que calcula días 
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $date2 = Carbon::parse('2019-11-16');
        $diferencia = $date2->diffInDays($date);
        return $diferencia;*/

    }

    public function obtenerCabecera(Request $request){
        $id = $request->id;
        $reserva = reserva::join('users','users.id','=','reserva.id_user')
        ->join('habitacion','habitacion.id','=','reserva.id_habitacion')
        ->join('tipo_habitacion','tipo_habitacion.id','=','habitacion.id_tipo_habitacion')
        ->select('reserva.id','reserva.nombre','reserva.email','reserva.fecha_reserva',
        'reserva.fecha_inicio','fecha_inicio as i','reserva.fecha_fin','fecha_fin as f','reserva.dias','reserva.adultos','reserva.ninos','reserva.descuento',
        'reserva.total','reserva.estado','habitacion.observacion','tipo_habitacion.nombre as nombre_tipo_habitacion','tipo_habitacion.descripcion as descripcion_tipo_habitacion','tipo_habitacion.tarifa',
        'users.name')->where('reserva.id','=',$id)->orderBy('reserva.id','desc')
        ->take(1)->get();
        return $reserva;
    }

    public function obtenerDetalle(Request $request){
        $id = $request->id;
        $detalle_reserva = detalle_reserva::join('servicio','servicio.id','=','detalle_reserva.id_servicio')
        ->select('detalle_reserva.cantidad','detalle_reserva.precio','servicio.nombre as nombre_detalle','detalle_reserva.id_servicio')
        ->where('detalle_reserva.id_reserva','=',$id)
        ->orderBy('detalle_reserva.id', 'desc')->get();
        return $detalle_reserva;
    }

    function generarCodigo($longitud) 
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.';
        $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
    }

    function Email($dates,$email){
        Mail::send('emails.Correo',$dates, function($message) use ($email){
          $message->subject('HOTEL ROYAL');
          $message->to($email);
          $message->from('no-repply@HotelMerecidoDescanso.com','HOTELROYAL');
        });
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
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50',
            'email' => 'required|email',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'dias' => 'required|integer',
            'adultos' => 'required|integer',
            'ninos' => 'integer',
            'descuento' => 'numeric',
            'total' => 'required|numeric'
        ],[
 
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Campo de tipo email',

            'fecha_inicio.required' => 'La fecha es obligatoria',
            'fecha_inicio.date' => 'Solo se acepta formato fecha',

            'fecha_fin.required' => 'La fecha es obligatoria',
            'fecha_fin.date' => 'Solo se acepta formato fecha',
            'fecha_fin.after' => 'La fecha final no puede ser menor a la de inicio',
            
            'dias.required' => 'Campo obligatorio',
            'dias.integer' => 'Solo se aceptan números enteros',

            'adultos.required' => 'Campo obligatorio',
            'adultos.integer' => 'Solo se aceptan números enteros',
            'adultos.min' => 'La cantidad de adultos supera la capacidad de la habitación',

            'ninos.integer' => 'Solo se aceptan números enteros',

            'descuento.numeric' => 'Solo se aceptan números',

            'total.required' => 'No ha seleccionado habitación',
            'total.numeric' => 'Solo se aceptan números'    
        ]);

        try {
            DB::beginTransaction();
            if (reserva::where('id_habitacion', '=', $request->id_habitacion)->count() < 1) {
                $date = Carbon::now();
                $date = $date->format('Y-m-d');
                $Codigo = $date.$this->generarCodigo(3);

                $reserva = new reserva();
                $reserva->id_user = \Auth::user()->id;
                $reserva->id_habitacion = $request->id_habitacion;
                $reserva->codigo = $Codigo;
                $reserva->nombre = $request->nombre;
                $reserva->email = $request->email;
                $reserva->fecha_reserva = $date;
                $reserva->fecha_inicio = $request->fecha_inicio;
                $reserva->fecha_fin = $request->fecha_fin;
                $reserva->dias = $request->dias;
                $reserva->adultos = $request->adultos;
                $reserva->ninos = $request->ninos;
                $reserva->descuento = $request->descuento;
                $reserva->total = $request->total;
                $reserva->estado = 'Confirmada';
                    
                $email=$request->email;
                $nombre = $request->nombre;
                $dates= array('nombre'=>$nombre, 'codigo'=>$Codigo);
                $this->Email($dates, $email);
                    
                $reserva->save();

                $detalle = $request->data;

                foreach($detalle as $ep=>$det){
                    $detalle_reserva = new detalle_reserva();
                    $detalle_reserva->id_reserva = $reserva->id;
                    $detalle_reserva->id_servicio = $det['id_servicio'];
                    $detalle_reserva->cantidad = $det['cantidad'];
                    $detalle_reserva->precio = $det['precio'];
                    $detalle_reserva->save();
                }
                DB::commit();
            }
            else{
                $v_finicio = $request->fecha_inicio;
                $validacion = reserva::where('id_habitacion','=',$request->id_habitacion)->get();
                $i = $validacion[0]->fecha_inicio;
                $f = $validacion[0]->fecha_fin;

                if(($v_finicio >= $i) && ($v_finicio <= $f))
                    return "nada";
                else{
                    $date = Carbon::now();
                    $date = $date->format('Y-m-d');
                    $Codigo = $date.$this->generarCodigo(3);

                    $reserva = new reserva();
                    $reserva->id_user = \Auth::user()->id;
                    $reserva->id_habitacion = $request->id_habitacion;
                    $reserva->codigo = $Codigo;
                    $reserva->nombre = $request->nombre;
                    $reserva->email = $request->email;
                    $reserva->fecha_reserva = $date;
                    $reserva->fecha_inicio = $request->fecha_inicio;
                    $reserva->fecha_fin = $request->fecha_fin;
                    $reserva->dias = $request->dias;
                    $reserva->adultos = $request->adultos;
                    $reserva->ninos = $request->ninos;
                    $reserva->descuento = $request->descuento;
                    $reserva->total = $request->total;
                    $reserva->estado = 'Confirmada';
                        
                    $email=$request->email;
                    $nombre = $request->nombre;
                    $dates= array('nombre'=>$nombre, 'codigo'=>$Codigo);
                    $this->Email($dates, $email);
                        
                    $reserva->save();

                    $detalle = $request->data;

                    foreach($detalle as $ep=>$det){
                        $detalle_reserva = new detalle_reserva();
                        $detalle_reserva->id_reserva = $reserva->id;
                        $detalle_reserva->id_servicio = $det['id_servicio'];
                        $detalle_reserva->cantidad = $det['cantidad'];
                        $detalle_reserva->precio = $det['precio'];
                        $detalle_reserva->save();
                    }
                    DB::commit();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function store_guest(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|regex:/^[a-zA-Z\s]+$/u|max:50',
            'email' => 'required|email',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'dias' => 'required|integer',
            'adultos' => 'required|integer',
            'ninos' => 'integer',
            'descuento' => 'numeric',
            'total' => 'required|numeric'
        ],[
 
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex' => 'Solo se acepta caracteres alfabéticos',
            'nombre.max' => 'Solo se acepta 50 caracteres',

            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Campo de tipo email',

            'fecha_inicio.required' => 'La fecha es obligatoria',
            'fecha_inicio.date' => 'Solo se acepta formato fecha',

            'fecha_fin.required' => 'La fecha es obligatoria',
            'fecha_fin.date' => 'Solo se acepta formato fecha',
            'fecha_fin.after' => 'La fecha final no puede ser menor a la de inicio',
            
            'dias.required' => 'Campo obligatorio',
            'dias.integer' => 'Solo se aceptan números enteros',

            'adultos.required' => 'Campo obligatorio',
            'adultos.integer' => 'Solo se aceptan números enteros',
            'adultos.min' => 'La cantidad de adultos supera la capacidad de la habitación',

            'ninos.integer' => 'Solo se aceptan números enteros',

            'descuento.numeric' => 'Solo se aceptan números',

            'total.required' => 'No ha seleccionado habitación',
            'total.numeric' => 'Solo se aceptan números'    
        ]);

        try {
            DB::beginTransaction();
            if (reserva::where('id_habitacion', '=', $request->id_habitacion)->count() < 1) {
                $date = Carbon::now();
                $date = $date->format('Y-m-d');
                $Codigo = $date.$this->generarCodigo(3);

                $reserva = new reserva();
                $reserva->id_user = \Auth::user()->id;
                $reserva->id_habitacion = $request->id_habitacion;
                $reserva->codigo = $Codigo;
                $reserva->nombre = $request->nombre;
                $reserva->email = $request->email;
                $reserva->fecha_reserva = $date;
                $reserva->fecha_inicio = $request->fecha_inicio;
                $reserva->fecha_fin = $request->fecha_fin;
                $reserva->dias = $request->dias;
                $reserva->adultos = $request->adultos;
                $reserva->ninos = $request->ninos;
                $reserva->descuento = $request->descuento;
                $reserva->total = $request->total;
                $reserva->estado = 'Confirmada';
                    
                $email=$request->email;
                $nombre = $request->nombre;
                $dates= array('nombre'=>$nombre, 'codigo'=>$Codigo);
                $this->Email($dates, $email);
                    
                $reserva->save();

                $detalle = $request->data;

                foreach($detalle as $ep=>$det){
                    $detalle_reserva = new detalle_reserva();
                    $detalle_reserva->id_reserva = $reserva->id;
                    $detalle_reserva->id_servicio = $det['id_servicio'];
                    $detalle_reserva->cantidad = $det['cantidad'];
                    $detalle_reserva->precio = $det['precio'];
                    $detalle_reserva->save();
                }
                DB::commit();
            }
            else{
                $v_finicio = $request->fecha_inicio;
                $validacion = reserva::where('id_habitacion','=',$request->id_habitacion)->get();
                $i = $validacion[0]->fecha_inicio;
                $f = $validacion[0]->fecha_fin;

                if(($v_finicio >= $i) && ($v_finicio <= $f))
                    return "nada";
                else{
                    $date = Carbon::now();
                    $date = $date->format('Y-m-d');
                    $Codigo = $date.$this->generarCodigo(3);

                    $reserva = new reserva();
                    $reserva->id_user = \Auth::user()->id;
                    $reserva->id_habitacion = $request->id_habitacion;
                    $reserva->codigo = $Codigo;
                    $reserva->nombre = $request->nombre;
                    $reserva->email = $request->email;
                    $reserva->fecha_reserva = $date;
                    $reserva->fecha_inicio = $request->fecha_inicio;
                    $reserva->fecha_fin = $request->fecha_fin;
                    $reserva->dias = $request->dias;
                    $reserva->adultos = $request->adultos;
                    $reserva->ninos = $request->ninos;
                    $reserva->descuento = $request->descuento;
                    $reserva->total = $request->total;
                    $reserva->estado = 'Confirmada';
                        
                    $email=$request->email;
                    $nombre = $request->nombre;
                    $dates= array('nombre'=>$nombre, 'codigo'=>$Codigo);
                    $this->Email($dates, $email);
                        
                    $reserva->save();

                    $detalle = $request->data;

                    foreach($detalle as $ep=>$det){
                        $detalle_reserva = new detalle_reserva();
                        $detalle_reserva->id_reserva = $reserva->id;
                        $detalle_reserva->id_servicio = $det['id_servicio'];
                        $detalle_reserva->cantidad = $det['cantidad'];
                        $detalle_reserva->precio = $det['precio'];
                        $detalle_reserva->save();
                    }
                    DB::commit();
                }
            }
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
        try {
            DB::beginTransaction();
            $reserva = reserva::findOrFail($request->id);
            $reserva->total = $request->total;
            $reserva->save();
            
            $detalle = $request->data;

            DB::table('detalle_reserva')->where('id_reserva','=',$request->id)->delete();
            foreach($detalle as $ep=>$det){
                $detalle_reserva = new detalle_reserva();
                $detalle_reserva->id_reserva = $request->id;
                $detalle_reserva->id_servicio = $det['id_servicio'];
                $detalle_reserva->cantidad = $det['cantidad'];
                $detalle_reserva->precio = $det['precio'];
                $detalle_reserva->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function checkIn(Request $request){
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $datetime = Carbon::now();
        $datetime = $datetime->format('Y-m-d H:i:s');

        $hola = reserva::findOrFail($request->id);
        $fecha_ = $hola->fecha_inicio;

        if($fecha_ == $date){
            $reserva = reserva::findOrFail($request->id);
            $id_habitacion = $reserva->id_habitacion;
            $reserva->estado = 'En uso';
            $reserva->save();

            $habitacion = habitacion::findOrFail($id_habitacion);
            $habitacion->estado = 'Ocupada';
            $habitacion->checkin = $datetime;
            $habitacion->save();
        }
    }

    public function checkOut(Request $request){
        $date = Carbon::now();
        $date = $date->format('Y-m-d H:i:s');

        $reserva = reserva::findOrFail($request->id);
        $id_habitacion = $reserva->id_habitacion;
        $reserva->estado = ' ';
        $reserva->save();

        $habitacion = habitacion::findOrFail($id_habitacion);
        $habitacion->estado = 'Mantenimiento';
        $habitacion->checkout = $date;
        $habitacion->save();
    }

    public function desactivate(Request $request){
        $reserva = reserva::findOrFail($request->id);
        $reserva->estado = 'Anulada';
        $reserva->save();
    }

    public function pdf(Request $request,$id){
        $reserva = reserva::join('users','users.id','=','reserva.id_user')
        ->join('habitacion','habitacion.id','=','reserva.id_habitacion')
        ->join('tipo_habitacion','tipo_habitacion.id','=','habitacion.id_tipo_habitacion')
        ->join('promocion','promocion.id','=','tipo_habitacion.id_promocion')
        ->select('reserva.id','reserva.id_habitacion','reserva.codigo',
        'reserva.nombre','reserva.email','reserva.fecha_reserva',
        'reserva.fecha_inicio','reserva.fecha_fin','reserva.dias','reserva.descuento',
        'reserva.total','habitacion.no_habitacion','habitacion.observacion',
        'habitacion.checkin','habitacion.checkout',
        'tipo_habitacion.nombre as nombre_tipo_habitacion','tipo_habitacion.descripcion as descripcion_tipo_habitacion',
        'tipo_habitacion.tarifa','promocion.porcentaje',
        'users.name')
        ->where('reserva.id','=',$id)
        ->orderBy('reserva.id','desc')
        ->take(1)
        ->get();
        
        $detalle_reserva = detalle_reserva::join('servicio','servicio.id','=','detalle_reserva.id_servicio')
        ->select('detalle_reserva.cantidad','detalle_reserva.precio','servicio.nombre as nombre_detalle','detalle_reserva.id_servicio')
        ->where('detalle_reserva.id_reserva','=',$id)
        ->orderBy('detalle_reserva.id', 'desc')
        ->get();

        $numreserva = reserva::select('id')->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.reserva',['reserva'=>$reserva,'detalle_reserva'=>$detalle_reserva]);
        return $pdf->download('reserva-'.$numreserva[0]->id.'.pdf');
    }
}
