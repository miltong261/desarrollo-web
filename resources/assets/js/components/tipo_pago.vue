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
                            <i class="fa fa-money"></i> TIPO PAGO
                            <button type="button" @click="openModal('Modal_Tipo_Pago','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_tipo_pago" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="tipo_pago in arrayTipo_Pago" :key="tipo_pago.id">
                                            <td v-text="tipo_pago.nombre"></td>
                                            <td class="AD">
                                                <div v-if="tipo_pago.estado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactivo</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <button type="button" @click="openModal('Modal_Tipo_Pago','update',tipo_pago)"  class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                                </button> &nbsp;
                                                <template v-if="tipo_pago.estado">  
                                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivate(tipo_pago.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>  
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(tipo_pago.id)">
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
                                        <label for="nombre">Nombre</label>
                                        <input type="text" v-model="nombre" class="form-control" name="nombre" placeholder="Ingrese Tipo Pago">
                                        <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                                    </div>                                  

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal()">Cerrar <i class="fa fa-times-circle"></i></button>
                        <button v-if="tipoAccion==1" type="button" @click="save()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                        <button v-if="tipoAccion==2" type="button" @click="update()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
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
                nombre: '',
                credito: '',
                debito: '',
                arrayTipo_Pago: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errors: []
            }
        },
        methods: {
            openModal(modelo,accion,data = []){
                switch(modelo){
                    case 'Modal_Tipo_Pago':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO DE TIPOS DE PAGO";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN DE TIPO DE PAGO";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = 0;
                this.nombre = '';
                this.errors = [];
                swal(
                    'Servicios',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            myTable(){
                var dataT = $('#lista_tipo_pago').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_tipo_pago').DataTable({
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
                var url = '/tipo_pago';
                axios.get(url).then(function (response) {
                    me.arrayTipo_Pago = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            save(){
                let me = this;
                var url = '/tipo_pago/save';
                axios.post(url,{
                    'nombre': this.nombre
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Tipos de pagos',
                        'Se ha registrado correctamente el tipo de pago',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = '/tipo_pago/update';
                axios.put(url,{
                    'nombre': this.nombre,
                    'id': this.id
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Tipos de pagos',
                        'Se ha actualizado correctamente el tipo de pago',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Tipo de pago',
                    text: "¿Estás seguro de cambiar el estado de este tipo de pago?",
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
                        var url = '/tipo_pago/activate';
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
                    title: 'Tipo de pago',
                    text: "¿Estás seguro de cambiar el estado de este tipo de pago?",
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
                        let me = this;
                        var url = '/tipo_pago/desactivate';
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
