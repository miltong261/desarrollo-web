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
                            <button type="button" @click="mostrarDetalle()" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->

                        <!-- Listado -->
                        <template v-if="listado==1">
                            <div class="box-body">
                                <div class="table-responsive col-md-12">
                                    <table id="lista_reserva" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>No. Habitación</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Fecha reserva</th>
                                                <th>Fecha entrada</th>
                                                <th>Fecha salida</th>
                                                <th>Días</th>
                                                <th>Descuento</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="reserva in arrayReserva" :key="reserva.id">
                                                <td v-text="reserva.codigo"></td>
                                                <td v-text="reserva.no_habitacion"></td>
                                                <td v-text="reserva.nombre"></td>
                                                <td v-text="reserva.email"></td>
                                                <td v-text="reserva.fecha_reserva"></td>
                                                <td v-text="reserva.fecha_inicio"></td>
                                                <td v-text="reserva.fecha_fin"></td>
                                                <td v-text="reserva.dias"></td>
                                                <td v-text="reserva.descuento"></td>
                                                <td v-text="reserva.total"></td>


                                                <td class="AD">
                                                    <div v-if="reserva.estado == 'Confirmada'">
                                                        <span class="badge badge-info w"><i class="fa fa-check-circle"></i> Confirmada</span>
                                                    </div>
                                                    <div v-else-if="reserva.estado == 'En uso'">
                                                        <span class="badge badge-success w"><i class="fa fa-bed"></i> Activa</span>
                                                    </div>
                                                    <div v-else-if="reserva.estado == ' '">
                                                        <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Pendiente</span>
                                                    </div>
                                                    <div v-else-if="reserva.estado == 'Cancelada'">
                                                        <span class="badge badge-success w"><i class="fa fa-money"></i> Cancelada</span>
                                                    </div>
                                                    <div v-else-if="reserva.estado == 'Anulada'">
                                                        <span class="badge badge-danger w"><i class="fa fa-ban"></i> Anulada</span>
                                                    </div>
                                                </td>

                                                <td class="AD">
                                                    <template v-if="reserva.estado === 'Confirmada'">
                                                        <!-- Ver, checkIn, anular -->
                                                        <button type="button" @click="verReserva(reserva.id)"  class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-success btn-sm" @click="checkIn(reserva.id)">
                                                            <i class="fa fa-check-circle"></i>
                                                        </button>
                                                        <br>

                                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivate(reserva.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                    </template>

                                                    <template v-if="reserva.estado === 'En uso'">
                                                        <!-- Modificar, Ver, checkOut -->
                                                        <button type="button" @click="verReserva(reserva.id)"  class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>

                                                        <button type="button" @click="agregarServicios(reserva.id)"  class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <br>

                                                        <button type="button" class="btn btn-danger btn-sm" @click="checkOut(reserva.id)">
                                                            <i class="fa fa-stop"></i>
                                                        </button>

                                                    </template>

                                                    <template v-else-if="reserva.estado === ' '">
                                                        <!-- Ver -->
                                                        <button type="button" @click="verReserva(reserva.id)"  class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button type="button" @click="openModal3(reserva)"  class="btn btn-success btn-sm">
                                                            <i class="fa fa-money"></i>
                                                        </button>
                                                    </template>

                                                    <template v-else-if="reserva.estado === 'Cancelada'">
                                                        <!-- Ver, PDF -->
                                                        <button type="button" @click="verReserva(reserva.id)"  class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <button type="button" @click="verPDF(reserva.id)"  class="btn btn-danger btn-sm">
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </button>
                                                    </template>

                                                    <template v-else-if="reserva.estado === 'Anulada'">
                                                        <!-- Ver -->
                                                        <button type="button" @click="verReserva(reserva.id)"  class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </template>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                        <!-- Fin listado -->

                        <!-- Reserva -->
                        <template v-else-if="listado==2">
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
                                            <input onkeypress="return event.charCode >= 48" class="form-control" v-model="adultos" name="adultos">
                                            <span style="color:red" v-if="errors.adultos">{{errors.adultos[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Niños</label>
                                            <input onkeypress="return event.charCode >= 48" class="form-control" v-model="ninos" name="ninos">
                                            <span style="color:red" v-if="errors.ninos">{{errors.ninos[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de entrada</label>
                                            <input type="date" class="form-control" v-model="fecha_inicio" name="fecha_inicio">
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
                                                    <td v-text="detalle.producto_nombre">

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
                                        <button type="button" @click="ocultarDetalle()" class="btn btn-danger">Cerrar</button>
                                        <button type="button" class="btn btn-info" @click="save()">Reservar</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Fin reserva -->

                        <!-- Actualizar reserva -->
                        <template v-else-if="listado==3">
                            <div class="box-body">
                                <div class="form-group row border">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input disabled type="text" class="form-control" v-model="nombre" name="nombre" placeholder="Ingrese nombre(*)">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correo electrónico</label>
                                            <input disabled type="email" class="form-control" v-model="email" name="email" placeholder="example@gmail.com">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Adultos</label>
                                            <input disabled class="form-control" v-model="adultos" name="adultos">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Niños</label>
                                            <input disabled class="form-control" v-model="ninos" name="ninos">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de entrada</label>
                                            <input disabled type="date" class="form-control" v-model="fecha_inicio" name="fecha_inicio">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de salida</label>
                                            <input disabled type="date" format="now()" class="form-control" v-model="fecha_fin" name="fecha_fin">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Días</label>
                                            <input disabled type="text" class="form-control" v-model="dias" name="dias">
                                        </div>
                                    </div>

                                    <!-- Habitaciones -->
                                    <div class="col-md-4">
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

                                    <div class="col-md-2">
                                        <label for="">Tarifa</label>
                                        <input type="text" disabled class="form-control" v-model="tarifa" name="tarifa" value="0">
                                    </div>

                                    <div class="col-md-1">
                                        <label for="">Descuento</label>
                                        <input type="text" disabled class="form-control" v-model="descuento" name="descuento">
                                    </div>

                                    <div class="col-md-1">
                                        <label for="">Pago</label>
                                        <input type="text" disabled class="form-control" v-model="pago" name="pago">
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
                                                        <input onkeypress="return event.charCode >= 48" v-model="detalle.cantidad" type="number" value="2" class="form-control">
                                                    </td>
                                                    <td>
                                                        {{detalle.precio*detalle.cantidad}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" align="right"><strong>Descuento:</strong></td>
                                                    <td>$ {{descuento}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" align="right"><strong>Total:</strong></td>
                                                    <td>$ {{total=((calcularTotal+calcularPago)-descuento)}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" align="right"><strong>Total:</strong></td>
                                                    <td>$ {{total=calcularTotal}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group row border">
                                    <div class="col-md-12">
                                        <button type="button" @click="ocultarDetalle()" class="btn btn-danger">Cerrar</button>
                                        <button type="button" class="btn btn-info" @click="update()">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Fin actualizar reserva -->

                        <!-- Ver reserva -->
                        <template v-else-if="listado==4">
                            <div class="box-body">
                                <div class="form-group row border">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <p disabled class="form-control" v-text="nombre"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correo electrónico</label>
                                            <p disabled class="form-control" v-text="email"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Adultos</label>
                                            <p disabled class="form-control" v-text="adultos"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Niños</label>
                                            <p disabled class="form-control" v-text="ninos"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de entrada</label>
                                            <p disabled class="form-control" v-text="fecha_inicio"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de salida</label>
                                            <p disabled class="form-control" v-text="fecha_fin"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Días</label>
                                            <p disabled class="form-control" v-text="dias"></p>
                                        </div>
                                    </div>

                                    <!-- Habitaciones -->
                                    <div class="col-md-4">
                                        <label for="">Observación</label>
                                        <p disabled class="form-control" v-text="observacion"></p>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="">Tipo de habitación</label>
                                        <p disabled class="form-control" v-text="nombre_tipo_habitacion"></p>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="">Descripción</label>
                                        <p disabled class="form-control" v-text="descripcion_tipo_habitacion"></p>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="">Tarifa</label>
                                        <p disabled class="form-control" v-text="tarifa"></p>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="">Descuento</label>
                                        <p disabled class="form-control" v-text="descuento"></p>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="">Pago</label>
                                        <p disabled class="form-control" v-text="pago"></p>
                                    </div>
                                    <!-- Fin habitaciones -->
                                </div>

                                <div class="form-group row border">
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="arrayDetalle.length">
                                                <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                    <td v-text="detalle.nombre_detalle">
                                                    </td>
                                                    <td v-text="detalle.precio"></td>
                                                    <td v-text="detalle.cantidad"></td>
                                                    <td>
                                                        {{detalle.precio*detalle.cantidad}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" align="right"><strong>Descuento:</strong></td>
                                                    <td>$ {{descuento=descuento}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" align="right"><strong>Total:</strong></td>
                                                    <td>$ {{total}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" align="right"><strong>Total:</strong></td>
                                                    <td>$ {{total}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group row border">
                                    <div class="col-md-12">
                                        <button type="button" @click="ocultarDetalle()" class="btn btn-danger">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <!-- Fin ver reserva -->
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


                                            <td class="AD">
                                                <button type="button" @click="agregarDetalleModal(servicio)"  class="btn btn-success btn-sm">
                                                    <i class="fa fa-check-circle"></i>
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
                                            <th>Capacidad</th>
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
                                            <template v-if="habitacion.capacidad == 1">
                                                <td v-text="habitacion.capacidad+' '+'Persona'"></td>
                                            </template>
                                            <template v-else>
                                                <td v-text="habitacion.capacidad+' '+'Personas'"></td>
                                            </template>
                                            <td class="AD">
                                                <button type="button" @click="agregarDetalleModalH(habitacion)"  class="btn btn-success btn-sm">
                                                    <i class="fa fa-check-circle"></i>
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

        <!-- Modal para pagar -->
        <div class="modal fade in" :class="{'mostrar': modalp}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button @click="closeModalP()" type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="text-center text-white"><i class="fa fa-credit-card-alt"></i></h4>
                        <h4 class="modal-title text-center text-white" v-text="tituloModal"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">INFORMACIÓN DE PAGO</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="nombre">No. de reserva</label>
                                        <input disabled type="text" v-model="id" class="form-control" name="id">
                                    </div>

                                    <div class="form-group">
                                        <label>No. de habitación</label>
                                        <textarea disabled class="form-control" v-model="no_habitacion" name="no_habitacion" rows="3"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Total Q.</label>
                                        <input disabled type="text" class="form-control" v-model="total" name="total" rows="3"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>Pendiente Q.</label>
                                        <input disabled type="text" class="form-control" v-model="pendiente" name="pendiente" rows="3"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>Tipo de pago</label>
                                        <select class="form-control" v-model="id_tipo_pago">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipo_pago in arrayTipo_Pago" :key="tipo_pago.id" :value="tipo_pago.id" v-text="tipo_pago.nombre"></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Q. </label>
                                        <input onkeypress="return event.charCode > 45" type="text" class="form-control" v-model="monto" name="monto" rows="3" placeholder="0.0"></input>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModalP()">Cerrar <i class="fa fa-times-circle"></i></button>
                        <button type="button" v-if="tipoAccion==1" @click="savePago()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                        <button type="button" v-if="tipoAccion==2" @click="update()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
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
              arrayProducto: [
                {
                  "id": 1,
                  "nombre": milton
                },
                {
                  "id": 2,
                  "nombre": juanito
                }
              ],
              arrayDetalle: [],
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

                arrayTipo_Pago: [],
                id_tipo_pago: 0,

                pendiente: ' ',
                monto: 0,

                listado: 1,
                modal: 0,
                modalh: 0,
                modalp: 0,
                tituloModal: "",
                tipoAccion: 0,
                errorPago: 0,
                errorMostrarMsjPago: [],
                errors: [],

                producto_id: 0,
                producto_nombre: ''
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
            openModal3(data = []){
                let me=this;
                var arrayPago=[];
                var url= '/pago/Pago?id=' + data['id'];
                axios.get(url).then(function (response) {
                    console.log(response);
                    arrayPago = response.data;
                    me.pendiente= arrayPago[0]['pendiente'];
                    if(me.pendiente == null)
                        me.pendiente = ' ';
                    else
                        me.pendiente = me.total - me.pendiente;
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.modalp = 1;
                this.tituloModal = "PAGOS";
                this.tipoAccion = 1;
                this.id = data['id'];
                this.pendiente = data['pendiente'];
                this.no_habitacion = data['no_habitacion'];
                this.total = data['total'];
                this.showTipoPago();
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
            closeModalP(){
                this.modalp = 0;
                this.tituloModal = 0;
                swal(
                    'Pagos',
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
            mostrarDetalle(){
                this.clear();
                this.listado = 2;
                this.myTable();
                this.showList();
            },
            ocultarDetalle(){
                this.listado = 1;
                this.myTable();
                this.showList();
            },
            myTable(){
                var dataT = $('#lista_reserva').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_reserva').DataTable({
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
            showList(){
                let me = this;
                var url = '/reserva';
                axios.get(url).then(function (response) {
                    me.arrayReserva = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
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
            Pago(id){
                let me = this;
                var url = '/pago/Pago?id=' +id;
                axios.get(url).then(function (response) {
                    me.arrayPago = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            showTipoPago(){
               let me = this;
               var url = '/tipo_pago/selectTipoPago';
                axios.get(url).then(function (response) {
                    me.arrayTipo_Pago = response.data;
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
                   console.log('no se puede')
                }else{
                    me.arrayDetalle.push({
                    producto_id: data['id'],
                    producto_nombre: data['nombre'],
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
            clearPago(){
                this.id = '',
                this.no_habitacion = '';
                this.total = '';
                this.pendiente = '';
                this.id_tipo_pago = 0;
                this.monto = 0;
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
                var url = '/reserva/save';
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
                    me.ocultarDetalle();
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
            savePago(){
                let me = this;
                var url = '/pago/save';
                axios.post(url,{
                    'id': this.id,
                    'id_tipo_pago': this.id_tipo_pago,
                    'monto': this.monto,
                    'pendiente': this.pendiente,
                    'total': this.total
                }).then(function (response) {
                    me.clearPago();
                    me.closeModalP();
                    me.myTable();
                    me.showList();
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
            agregarServicios(id){
                let me=this;
                me.listado=3;
                me.myTable();
                me.showList();

                /* Obtiene los datos de la reserva */
                var arrayReservaT=[];
                var url= '/reserva/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    console.log(response);
                    arrayReservaT = response.data;

                    me.id = arrayReservaT[0]['id'];
                    me.nombre = arrayReservaT[0]['nombre'];
                    me.email=arrayReservaT[0]['email'];
                    me.adultos=arrayReservaT[0]['adultos'];
                    me.ninos=arrayReservaT[0]['ninos'];
                    me.fecha_inicio=arrayReservaT[0]['fecha_inicio'];
                    me.fecha_fin=arrayReservaT[0]['fecha_fin'];
                    me.dias = arrayReservaT[0]['dias'];
                    me.observacion = arrayReservaT[0]['observacion'];
                    me.nombre_tipo_habitacion = arrayReservaT[0]['nombre_tipo_habitacion'];
                    me.descripcion_tipo_habitacion = arrayReservaT[0]['descripcion_tipo_habitacion'];
                    me.tarifa = arrayReservaT[0]['tarifa'];
                    me.descuento = arrayReservaT[0]['descuento'];
                    me.pago = ((me.dias * me.tarifa) - me.descuento);
                    me.total= arrayReservaT[0]['total'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                /* Obtiene los datos del detalle de reserva */
                var urld= '/reserva/obtenerDetalle?id=' + id;

                axios.get(urld).then(function (response) {
                    console.log(response);
                    me.arrayDetalle = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            verReserva(id){
                let me=this;
                me.listado=4;
                me.myTable();
                me.showList();

                /* Obtiene los datos de la reserva */
                var arrayReservaT=[];
                var url= '/reserva/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    console.log(response);
                    arrayReservaT = response.data;

                    me.id = arrayReservaT[0]['id'];
                    me.nombre = arrayReservaT[0]['nombre'];
                    me.email=arrayReservaT[0]['email'];
                    me.adultos=arrayReservaT[0]['adultos'];
                    me.ninos=arrayReservaT[0]['ninos'];
                    me.fecha_inicio=arrayReservaT[0]['fecha_inicio'];
                    me.fecha_fin=arrayReservaT[0]['fecha_fin'];
                    me.dias = arrayReservaT[0]['dias'];
                    me.observacion = arrayReservaT[0]['observacion'];
                    me.nombre_tipo_habitacion = arrayReservaT[0]['nombre_tipo_habitacion'];
                    me.descripcion_tipo_habitacion = arrayReservaT[0]['descripcion_tipo_habitacion'];
                    me.tarifa = arrayReservaT[0]['tarifa'];
                    me.descuento = arrayReservaT[0]['descuento'];
                    me.pago = ((me.dias * me.tarifa) - me.descuento);
                    me.total= arrayReservaT[0]['total'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                /* Obtiene los datos del detalle de reserva */
                var urld= '/reserva/obtenerDetalle?id=' + id;

                axios.get(urld).then(function (response) {
                    console.log(response);
                    me.arrayDetalle = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            verPDF(id){
                window.open('/reserva/pdf/'+ id + ',' + '_blank');
            },
            update(id){
                let me = this;
                var url = '/reserva/update';
                axios.put(url,{
                    'total': this.total,
                    'data': this.arrayDetalle,
                    'id': this.id
                }).then(function (response) {
                    me.clear();
                    me.ocultarDetalle();
                    swal(
                        'Reserva',
                        'Reservación actualizada',
                        'success'
                    )

                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            checkIn(id){
                swal({
                    title: 'Reserva',
                    text: "ChekIn",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Aceptar!',
                    cancelButtonText: '¡Cancelar!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this
                        var url = '/reserva/checkIn';
                        axios.put(url,{
                        'id': id
                        }).then(function (response) {
                            me.showList();
                            swal(
                                'Activado',
                                'Se ha cambiado de estado correctamente',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }else if (result.dismiss === swal.DismissReason.cancel){
                        swal(
                            'Cancelado',
                            'Se ha cancelado la operación correctamente',
                            'error'
                        )
                    }
                })
            },
            checkOut(id){
                swal({
                    title: 'Reserva',
                    text: "ChekOut",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Aceptar!',
                    cancelButtonText: '¡Cancelar!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this
                        var url = '/reserva/checkOut';
                        axios.put(url,{
                        'id': id
                        }).then(function (response) {
                            me.showList();
                            swal(
                                'Activado',
                                'Se ha cambiado de estado correctamente',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }else if (result.dismiss === swal.DismissReason.cancel){
                        swal(
                            'Cancelado',
                            'Se ha cancelado la operación correctamente',
                            'error'
                        )
                    }
                })
            },
            desactivate(id){
                swal({
                    title: 'Reserva',
                    text: "¿Estás seguro anular esta reserva?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Aceptar!',
                    cancelButtonText: '¡Cancelar!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this
                        var url = '/reserva/desactivate';
                        axios.put(url,{
                        'id': id
                        }).then(function (response) {
                            me.showList();
                            swal(
                                'Desactivado',
                                'Se ha anulado la reserva correctamente',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }else if (result.dismiss === swal.DismissReason.cancel){
                        swal(
                            'Cancelado',
                            'Se ha cancelado la operación correctamente',
                            'error'
                        )
                    }
                })
            },
            validarFechas(){
                this.errorPago=0;
                this.errorMostrarMsjPago =[];

                var inicio = moment().format("YYYY-MM-DD");   ;
                if (this.fecha_inicio<inicio) this.errorMostrarMsjPago.push("Fecha incorrecta");

                if (this.errorMostrarMsjPago.length) this.errorPago = 1;

                return this.errorPago;
            },
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
        },
        mounted() {
            this.showList();
        }
    }
</script>
