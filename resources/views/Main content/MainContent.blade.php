@extends('Principal')
@section('content')

    @if(Auth::check())
        @if(Auth::user()->id_rol == 1)
            <template v-if="menu==6">
                <user></user>
            </template>
            
            <template v-if="menu==1">
                <promocion></promocion>
            </template>
                
            <template v-if="menu==2">
                <tipo_pago></tipo_pago>
            </template>
            
            <template v-if="menu==3">
                <servicio></servicio>
            </template>
            
            <template v-if="menu==4">
                <tipo_habitacion></tipo_habitacion>
            </template>
            
            <template v-if="menu==5">
                <habitacion></habitacion>
            </template>

            <template v-if="menu==7">
                <reserva></reserva>
            </template>
        @elseif(Auth::user()->id_rol == 2)
            <template v-if="menu==5">
                <habitacion></habitacion>
            </template>

            <template v-if="menu==7">
                <reserva></reserva>
            </template>
        @elseif(Auth::user()->id_rol == 3)
        <template v-if="menu==8">
            <reserva_guest></reserva_guest>
        </template>
        @endif
    @endif
    
@endsection