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
                            <i class="fa fa-bed"></i> HABITACIÓN
                            <button type="button" @click="openModal('Modal_Habitacion','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_habitacion" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Número de habitación</th>
                                            <th>Tipo de habitación</th>
                                            <th>Observacion</th>
                                            <th>Estado</th>
                                            <th>Habitación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="habitacion in arrayHabitacion" :key="habitacion.id">
                                            <td v-text="habitacion.no_habitacion"></td>
                                            <td v-text="habitacion.nombre_tipo_habitacion"></td>
                                            <td v-text="habitacion.observacion"></td>
                                            <td class="AD">
                                                <div v-if="habitacion.estado === 'Disponible'">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Disponible</span>
                                                </div>
                                                <div v-else-if="habitacion.estado === 'Ocupada'">
                                                    <span class="badge badge-danger w"><i class="fa fa-ban"></i> Ocupada</span>
                                                </div>
                                                <div v-else-if="habitacion.estado === 'Mantenimiento'">
                                                    <span class="badge badge-info w"><i class="fa fa-bed"></i> Mantenimiento</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> No disponible</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <div v-if="habitacion.habilitado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activa</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactiva</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <template v-if="habitacion.estado === 'Disponible'">
                                                    <button type="button" @click="openModal('Modal_Habitacion','update',habitacion)"  class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    </button>
                                                </template> &nbsp;
                                                
                                                <template v-if="habitacion.estado === 'Disponible'">
                                                    <template v-if="habitacion.habilitado">  
                                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivate(habitacion.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    
                                                    <template v-else>  
                                                        <button type="button" class="btn btn-info btn-sm" @click="activate(habitacion.id)">
                                                            <i class="fa fa-check-circle"></i>
                                                        </button>
                                                    </template>
                                                </template> &nbsp;

                                                <template v-if="habitacion.estado === 'No disponible'">
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(habitacion.id)">
                                                            <i class="fa fa-check-circle"></i>
                                                        </button>
                                                </template>

                                                <template v-if="habitacion.estado === 'Mantenimiento'">  
                                                    <button type="button" class="btn btn-success btn-sm" @click="available(habitacion.id)">
                                                        <i class="fa fa-bed"></i>
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
                                        <label>Tipo de habitación</label>
                                        <select class="form-control" v-model="id_tipo_habitacion">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipo_habitacion in arrayTipo_Habitacion" :key="tipo_habitacion.id" :value="tipo_habitacion.id" v-text="tipo_habitacion.nombre"></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Observación</label>
                                        <textarea class="form-control" v-model="observacion" name="observacion" rows="3" placeholder="*Opcional*"></textarea>
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
                id: 0,
                id_tipo_habitacion: 0,
                observacion: '',
                nombre_tipo_habitacion: '',
                arrayHabitacion: [],
                arrayTipo_Habitacion: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errors: []
            }
        },
        methods: {
            openModal(modelo,accion,data = []){
                switch(modelo){
                    case 'Modal_Habitacion':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO DE HABITACIONES";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN HABITACIONES";
                                this.tipoAccion = 2;
                                this.id_tipo_habitacion = data['id_tipo_habitacion'];
                                this.observacion = data['observacion'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
                this.showTipoHabitacion();
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = 0;
                this.id_tipo_habitacion = 0;
                this.observacion = ''; 
                this.errors = [];
                swal(
                    'Habitaciones',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            myTable(){
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
            showList(){
                let me = this;
                var url = '/habitacion';
                axios.get(url).then(function (response) {
                    me.arrayHabitacion = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            showTipoHabitacion(){
               let me = this;
               var url = '/tipo_habitacion/selectTipoHabitacion';
                axios.get(url).then(function (response) {
                    me.arrayTipo_Habitacion = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            save(){
                let me = this;
                var url = '/habitacion/save';
                axios.post(url,{
                    'id_tipo_habitacion': this.id_tipo_habitacion,
                    'observacion': this.observacion
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Habitaciones',
                        'Se ha registrado correctamente la habitación',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = '/habitacion/update';
                axios.put(url,{
                    'id_tipo_habitacion': this.id_tipo_habitacion,
                    'observacion': this.observacion,
                    'id': this.id
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Habitaciones',
                        'Se ha actualizado la habitación correctamente',
                        'success'
                    )
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Habitación',
                    text: "¿Estás seguro de cambiar el estado de esta habitación?",
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
                        var url = '/habitacion/activate';
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
                    title: 'Habitación',
                    text: "¿Estás seguro de cambiar el estado de esta habitación?",
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
                        var url = '/habitacion/desactivate';
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
            },
            available(id){
                swal({
                    title: 'Habitación',
                    text: "¿Estás seguro que la habitación ya esta disponible?",
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
                        var url = '/habitacion/available';
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
            }
        },
        mounted() {
            this.showList();
        }
    }
</script>
