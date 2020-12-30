<template>
    <div>
        <!-- Contenido principal "cabecna" -->
        <section class="content-header">
            <h1><i class="fa fa-align-justify"></i> TABLERO<small>HOTEL</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>
        <!-- Fin contenido principal "cabecera" -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <i class="fa fa-bookmark"></i> RERSERVAS
                        </div>
                        <!-- /.box-header -->

                        <!-- Detalle -->
                        <div class="box-body">
                            <div class="form-group row border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control" v-model="nombre" name="nombre" placeholder="Ingrese nombre(*)">
                                        <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="email" class="form-control" v-model="email" name="email" placeholder="example@gmail.com">
                                        <span style="color:red" v-if="errors.email">{{errors.email[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Adultos</label>
                                        <input class="form-control" v-model="adultos" name="adultos">
                                        <span style="color:red" v-if="errors.adultos">{{errors.adultos[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Niños</label>
                                        <input class="form-control" v-model="ninos" name="ninos">
                                        <span style="color:red" v-if="errors.ninos">{{errors.ninos[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha de entrada</label>
                                        <input id="hola" type="date" class="form-control" v-model="fecha_inicio" name="fecha_inicio">
                                        <span style="color:red" v-if="errors.fecha_inicio">{{errors.fecha_inicio[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha de salida</label>
                                        <input type="date" format="now()" class="form-control" v-model="fecha_fin" name="fecha_fin">
                                        <span style="color:red" v-if="errors.fecha_fin">{{errors.fecha_fin[0]}}</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Días</label>
                                        <input id="res" type="text" disabled class="form-control" v-model="diferenciaDias">
                                        <span style="color:red" v-if="errors.dias">{{errors.dias[0]}}</span>
                                    </div>
                                </div>

                                <!-- Habitaciones -->
                                <div class="col-md-1">
                                    <label for="">Habitaciones</label>
                                    <button @click="openModal2('Modal_Habitacion','habitacion')" class="btn btn-info form-control"><i class="fa fa-search"></i></button>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Observación</label>
                                    <input type="text" disabled class="form-control" v-model="observacion" name="observacion">
                                </div>

                                <div class="col-md-2">
                                    <label for="">Tipo de habitación</label>
                                    <input type="text" disabled class="form-control" v-model="nombre_tipo_habitacion" name="tarifa">
                                </div>

                                <div class="col-md-2">
                                    <label for="">Descripción</label>
                                    <input type="text" disabled class="form-control" v-model="descripcion_tipo_habitacion" name="descuento" value="0">
                                </div>

                                <div class="col-md-1">
                                    <label for="">Capacidad</label>
                                    <input type="text" disabled class="form-control" v-model="capacidad" name="capacidad" value="0">
                                </div>

                                <div class="col-md-1">
                                    <label for="">Tarifa</label>
                                    <input type="text" disabled class="form-control" v-model="tarifa" name="tarifa" value="0">
                                </div>

                                <div class="col-md-1">
                                    <label for="">Descuento</label>
                                    <input type="text" disabled class="form-control" v-model="calcularDescuento">
                                    <span style="color:red" v-if="errors.descuento">{{errors.descuento[0]}}</span>
                                </div>

                                <div class="col-md-1">
                                    <label for="">Pago</label>
                                    <input type="text" disabled class="form-control" v-model="calcularPago">
                                </div>
                                <!-- Fin habitaciones -->

                                <!-- Servicios -->
                                <div class="col-md-1">
                                    <label for="">Servicios</label>
                                    <button @click="openModal('Modal_Reserva','servicio')" class="btn btn-info form-control"><i class="fa fa-search"></i></button>
                                </div>
                                <!-- Fin servicios -->
                            </div>
                            
                            <div class="form-group row border">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                <td class="AD">
                                                    <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times-circle"></i>
                                                    </button>
                                                </td>
                                                <td v-text="detalle.nombre_detalle">
                                                </td>
                                                <td v-text="detalle.precio"></td>
                                                <td>
                                                    <input onkeypress="return event.charCode >= 48" min="1" v-model="detalle.cantidad" type="number" value="2" class="form-control">
                                                </td>
                                                <td>
                                                    {{detalle.precio*detalle.cantidad}}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                                <td>$ {{totalParcial=(total+calcularDescuento).toFixed(2)}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Descuento:</strong></td>
                                                <td>$ {{calcularDescuento}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total:</strong></td>
                                                <td>$ {{total=(calcularTotal+calcularPago)}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total:</strong></td>
                                                <td>$ {{total=calcularPago}}</td>
                                            </tr>
                                        </tbody>                                    
                                    </table>
                                </div>
                            </div>
                            
                            <div class="form-group row border">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-info" @click="save()">Reservar</button>
                                </div>
                            </div>
                        </div>
                        <!-- Fin detalle -->
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal para servicios -->
        <div class="modal fade in" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button @click="closeModal()" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="text-center text-white"><i class="fa fa-credit-card-alt"></i></h4>
                        <h4 class="modal-title text-center text-white" v-text="tituloModal"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="table-responsive">
                                <table id="lista_servicio" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="servicio in arrayServicio" :key="servicio.id">
                                            <td v-text="servicio.nombre"></td>
                                            <td v-text="servicio.descripcion"></td>
                                            <td v-text="servicio.precio"></td>

                                            <td class="AD">
                                                <button type="button" @click="agregarDetalleModal(servicio)"  class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button> &nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal()">Cerrar <i class="fa fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para habitaciones -->
        <div class="modal fade in" :class="{'mostrar': modalh}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button @click="closeModalH()" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="text-center text-white"><i class="fa fa-credit-card-alt"></i></h4>
                        <h4 class="modal-title text-center text-white" v-text="tituloModal"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="table-responsive">
                                <table id="lista_habitacion" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. Habitación</th>
                                            <th>Observación</th>
                                            <th>Tipo de habitación</th>
                                            <th>Descripción</th>
                                            <th>Tarifa</th>
                                            <th>Porcentaje</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="habitacion in arrayHabitacion" :key="habitacion.id">
                                            <td v-text="habitacion.no_habitacion"></td>
                                            <td v-text="habitacion.observacion"></td>
                                            <td v-text="habitacion.nombre_tipo_habitacion"></td>
                                            <td v-text="habitacion.descripcion_tipo_habitacion"></td>
                                            <td v-text="habitacion.tarifa"></td>
                                            <td v-text="habitacion.porcentaje"></td>
                                            <td class="AD">
                                                <button type="button" @click="agregarDetalleModalH(habitacion)"  class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button> &nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModalH()">Cerrar <i class="fa fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
    export default {
        data(){
            return{
                id: 0,
                name: '',
                nombre: '',
                email: '',
                fecha_reserva: '',
                fecha_inicio: '',
                fecha_fin: '',
                dias: '',
                adultos: '',
                ninos: '',
                descuento: 0,
                total: 0.0,
                totalParcial: 0.0,
                
                arrayReserva: [],
                arrayDetalle: [],
                
                arrayServicio: [],
                id_servicio: 0,
                nombre_detalle: '',
                cantidad: 0,
                precio: 0,
                
                arrayHabitacion: [],
                id_habitacion: 0,
                no_habitacion: '',
                observacion: '',
                nombre_tipo_habitacion: '',
                descripcion_tipo_habitacion: '',
                capacidad: '',
                i: '',
                f: '',
                porcentaje: '',
                tarifa: '',
                pago: '',
                
                listado: 1,
                modal: 0,
                modalh: 0,
                tituloModal: "",
                tipoAccion: 0,
                errorReserva : 0,
                errorMostrarMsjReserva : [],
                errors: []
            }
        },
        methods: {
            openModal(modelo,accion){
                switch(modelo){
                    case 'Modal_Reserva':{
                        switch(accion){
                            case 'servicio':{
                                this.modal = 1;
                                this.tituloModal = "SELECCIONE SERVICIOS";
                                this.tipoAccion = 1;
                                this.listarServicio();
                                break;
                            }
                        }
                    }
                }
            },
            openModal2(modelo,accion){
                switch(modelo){
                    case 'Modal_Habitacion':{
                        switch(accion){
                            case 'habitacion':{
                                this.modalh = 1;
                                this.tituloModal = "SELECCIONE HABITACIÓN";
                                this.tipoAccion = 1;
                                this.listarHabitacion();
                                break;
                            }
                        }
                    }
                }
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = 0;
                swal(
                    'Servicios',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            closeModalH(){
                this.modalh = 0;
                this.tituloModal = 0;
                swal(
                    'Habitaciones',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            closeHabitacionSeleccionada(){
                this.modalh = 0;
                this.tituloModal = 0;
                swal(
                    'Habitaciones',
                    'Habitación seleccionada correctamente',
                    'success'
                )
            },
            servicioTable(){
                var dataT = $('#lista_servicio').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_servicio').DataTable({
                        responsive: true,
                        language: {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        }
                    });
                });
            },
            listarServicio(){
                let me = this;
                var url = '/servicio/listarServicio';
                axios.get(url).then(function (response) {
                    me.arrayServicio = response.data;
                    me.servicioTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            habitacionTable(){
                var dataT = $('#lista_habitacion').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_habitacion').DataTable({
                        responsive: true,
                        language: {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        }
                    });
                });
            },
            listarHabitacion(){
                let me = this;
                var url = '/habitacion/listarHabitacion';
                axios.get(url).then(function (response) {
                    me.arrayHabitacion = response.data;
                    me.habitacionTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].id_servicio==id){
                        sw=true;
                    }
                }
                return sw;
            },
            agregarDetalleModal(data = []){
                let me = this;
                if(me.encuentra(data['id'])){
                    swal(
                        'Servicios',
                        'El servicio ya se encuentra seleccionado',
                        'error'
                    )
                }else{
                    me.arrayDetalle.push({
                    id_servicio: data['id'],
                    nombre_detalle: data['nombre'],
                    cantidad: 1,
                    precio: data['precio']
                });
                }
            },
            agregarDetalleModalH(data = []){
                this.id_habitacion = data['id'],
                this.observacion = data['observacion'],
                this.nombre_tipo_habitacion = data['nombre_tipo_habitacion'],
                this.descripcion_tipo_habitacion = data['descripcion_tipo_habitacion'],
                this.capacidad = data['capacidad'];
                this.i = data['i'];
                this.f = data['f'];
                this.tarifa = data['tarifa'],
                this.porcentaje = data['porcentaje'];
                this.closeHabitacionSeleccionada();
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            clear(){
                this.id_habitacion = 0;
                this.observacion = '';
                this.nombre_tipo_habitacion = '';
                this.descripcion_tipo_habitacion = '';
                this.tarifa = 0.0;
                this.pago = 0.0;
                this.nombre = '';
                this.email = '';
                this.fecha_inicio = '';
                this.fecha_fin = '';
                this.dias = '';
                this.adultos = '';
                this.ninos = '';
                this.descuento = 0.0;
                this.total = 0.0;
                this.capacidad = 0;
                this.arrayDetalle = [];
            },
            save(){
                if(this.validarFechas()){
                    swal(
                        'Reserva',
                        'La fecha de entrada no puede ser menor a la fecha actual',
                        'error'
                    )
                    return;    
                }
                
                let me = this;
                var url = '/reserva/save_guest';
                axios.post(url,{
                    'id_habitacion': this.id_habitacion,
                    'nombre': this.nombre,
                    'email': this.email,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'dias': this.dias,
                    'adultos': this.adultos,
                    'ninos': this.ninos,
                    'descuento': this.descuento,
                    'total': this.total,
                    'data': this.arrayDetalle
                }).then(function (response) {
                    me.clear();
                    swal(
                        'Reserva',
                        'Reservación confirmada',
                        'success'
                    )
                    
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            validarFechas(){
                this.errorPago=0;
                this.errorMostrarMsjPago =[];

                var inicio = moment().format("YYYY-MM-DD");   ;
                if (this.fecha_inicio<inicio) this.errorMostrarMsjPago.push("Fecha incorrecta");

                if (this.errorMostrarMsjPago.length) this.errorPago = 1;

                return this.errorPago;
            }
        },
        computed: {
            calcularTotal: function(){
                var resultado=0.0;
                if(this.arrayDetalle.length == 0)
                    resultado=resultado+(this.pago)
                else{
                    for(var i=0;i<this.arrayDetalle.length;i++){
                        resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad)
                    }
                }
                return resultado;
            },
            diferenciaDias: function(){
                var inicio = moment(this.fecha_inicio);
                var fin = moment(this.fecha_fin);
                var dif = fin.diff(inicio,"day");
                this.dias = dif;
                return dif;
            },
            calcularPago: function(){
                var totalpago = 0.0;
                if(this.i <= this.fecha_inicio && this.f >= this.fecha_fin)
                    totalpago = totalpago + (this.tarifa*this.dias) - this.descuento;
                else if(this.i == null && this.f == null)
                    totalpago = totalpago + this.tarifa*this.dias;
                else
                    totalpago = totalpago + this.tarifa*this.dias;
                return totalpago;
            },
            calcularDescuento: function(){
                var totalDescuento = 0.0;
                if(this.i <= this.fecha_inicio && this.f >= this.fecha_fin){
                    totalDescuento = totalDescuento + ((this.tarifa * this.porcentaje)/100)*this.dias;
                    this.descuento = totalDescuento;
                }
                else if(this.i == null && this.f == null){
                    totalDescuento = totalDescuento + 0;
                    this.descuento = totalDescuento;
                }
                else{ 
                    totalDescuento = totalDescuento + 0;
                    this.descuento = totalDescuento;
                }
                return totalDescuento;
            }
        }
    }
</script>
