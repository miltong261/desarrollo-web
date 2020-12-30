<template>
    <div>
        <!-- Contenido principal "cabecera" -->
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
                            <i class="fa fa-wrench"></i> TIPO DE HABITACIÓN
                            <button type="button" @click="openModal('Modal_Tipo_Habitacion','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_tipo_habitacion" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Promoción</th>
                                            <th>Capacidad</th>
                                            <th>Tarifa</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="tipo_habitacion in arrayTipo_Habitacion" :key="tipo_habitacion.id">
                                            <td v-text="tipo_habitacion.nombre"></td>
                                            <td v-text="tipo_habitacion.descripcion"></td>
                                            <td v-text="tipo_habitacion.nombre_promocion"></td>
                                            <td v-text="tipo_habitacion.capacidad"></td>
                                            <td v-text="tipo_habitacion.tarifa"></td>
                                            <td class="AD">
                                                <div v-if="tipo_habitacion.estado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activa</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactiva</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <button type="button" @click="openModal('Modal_Tipo_Habitacion','update',tipo_habitacion)"  class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                                </button> &nbsp;
                                                <template v-if="tipo_habitacion.estado">  
                                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivate(tipo_habitacion.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>  
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(tipo_habitacion.id)">
                                                        <i class="fa fa-check-circle"></i>
                                                    </button>
                                                </template>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Modal para registrar y actualizar -->
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
                                <h3 class="box-title">INFORMACIÓN</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data" role="form">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" v-model="nombre" name="nombre" rows="3" placeholder="Ingrese nombre"></input>
                                        <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" v-model="descripcion" name="descripcion" rows="3" placeholder="*Opcional*"></textarea>
                                        <span style="color:red" v-if="errors.descripcion">{{errors.descripcion[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Promoción</label>
                                        <select class="form-control" v-model="id_promocion">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="promocion in arrayPromocion" :key="promocion.id" :value="promocion.id" v-text="promocion.nombre"></option>
                                        </select>
                                        <span style="color:red" v-if="errors.nombre_promocion">{{errors.nombre_promocion[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Capacidad de personas</label>
                                        <input onkeypress="return event.charCode >= 48" class="form-control" v-model="capacidad" name="capacidad" rows="3" placeholder="Ingrese capacidad"></input>
                                        <span style="color:red" v-if="errors.capacidad">{{errors.capacidad[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tarifa</label>
                                        <input class="form-control" onkeypress="return event.charCode > 45" v-model="tarifa" name="capacidad" rows="3" placeholder="Ingrese tarifa"></input>
                                        <span style="color:red" v-if="errors.tarifa">{{errors.tarifa[0]}}</span>
                                    </div>                                     
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal()">Cerrar <i class="fa fa-times-circle"></i></button>
                        <button type="button" v-if="tipoAccion==1" @click="save()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                        <button type="button" v-if="tipoAccion==2" @click="update()" class="btn btn-success">Actualizar <i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                isDisabled: true,
                id: 0,
                id_promocion: 0,
                nombre: '',
                descripcion: '',
                nombre_promocion: '',
                capacidad: '',
                tarifa: '',
                arrayTipo_Habitacion: [],
                arrayPromocion: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errors: []
            }
        },
        methods: {
            openModal(modelo,accion,data = []){
                switch(modelo){
                    case 'Modal_Tipo_Habitacion':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO TIPO DE HABITACIONES";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN TIPO DE HABITACIONES";
                                this.tipoAccion = 2;
                                this.id_promocion = data['id_promocion'];
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.capacidad = data['capacidad'];
                                this.tarifa = data['tarifa'];
                                this.precio = data['precio'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
                this.showPromocion();
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = 0;
                this.id_promocion = 0;
                this.nombre = '';
                this.descripcion = '';
                this.nombre_promocion = '';
                this.capacidad = '';
                this.tarifa = ''; 
                this.errors = [];
                swal(
                    'Tipo de habitaciones',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            myTable(){
                var dataT = $('#lista_tipo_habitacion').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_tipo_habitacion').DataTable({
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
                var url = '/tipo_habitacion';
                axios.get(url).then(function (response) {
                    me.arrayTipo_Habitacion = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            showPromocion(){
               let me = this;
               var url = '/promocion/selectPromocion';
                axios.get(url).then(function (response) {
                    me.arrayPromocion = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            save(){
                let me = this;
                var url = '/tipo_habitacion/save';
                axios.post(url,{
                    'id_promocion': this.id_promocion,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'capacidad': this.capacidad,
                    'tarifa': this.tarifa
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Tipo de habitaciones',
                        'Se ha registrado correctamente el tipo de habitación',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = '/tipo_habitacion/update';
                axios.put(url,{
                    'id_promocion': this.id_promocion,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'capacidad': this.capacidad,
                    'tarifa': this.tarifa,
                    'id': this.id
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Tipo de habitaciones',
                        'Se ha actualizado el tipo de habitación correctamente',
                        'success'
                    )
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Tipo de habitación',
                    text: "¿Estás seguro de cambiar el estado de este tipo de habitación?",
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
                        var url = '/tipo_habitacion/activate';
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
                    title: 'Tipo de habitación',
                    text: "¿Estás seguro de cambiar el estado de este tipo de habitación?",
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
                        var url = '/tipo_habitacion/desactivate';
                        axios.put(url,{
                        'id': id 
                        }).then(function (response) {
                            me.showList();
                            swal(
                                'Desactivado',
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
            }
        },
        mounted() {
            this.showList();
        }
    }
</script>
