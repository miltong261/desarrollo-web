<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pago;
use App\reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class pagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function Pago(Request $request){
        $pago = pago::where('id_reserva','=',$request->id)
        ->select(DB::raw('SUM(monto) as pendiente'))->get();

        if($pago)
            return $pago;
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
            $date = Carbon::now();
            $date = $date->format('Y-m-d H:i:s');
            $pago = new pago();
            $pago->id_reserva = $request->id;
            $pago->id_tipo_pago = $request->id_tipo_pago;
            $pago->fecha_pago = $date;
            if($request->pendiente == null)
                $pago->pendiente = $request->total - $request->monto;
            else
                $pago->pendiente = $request->pendiente - $request->monto;
            $pago->monto = $request->monto;
            $pago->estado = '1'; 
            $pago->save();

            if($pago->pendiente == 0){
                $reserva = reserva::findOrFail($request->id);
                $reserva->estado = 'Cancelada';
                $reserva->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
