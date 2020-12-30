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
                            <i class="fa fa-tags"></i> PROMOCIÓN
                            <button type="button" @click="openModal('Modal_Promocion','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_promocion" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha fin</th>
                                            <th>Porcentaje</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="promocion in arrayPromocion" :key="promocion.id">
                                            <td v-text="promocion.nombre"></td>
                                            <td v-text="promocion.descripcion"></td>
                                            <td v-text="promocion.fecha_inicio"></td>
                                            <td v-text="promocion.fecha_fin"></td>
                                            <td v-text="promocion.porcentaje"></td>
                                            <td class="AD">
                                                <div v-if="promocion.estado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activa</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactiva</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <template v-if="promocion.nombre != 'Sin promocion'">
                                                    <button type="button" @click="openModal('Modal_Promocion','update',promocion)"  class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </button> &nbsp;
                                                </template>
                                                <template v-if="promocion.estado">
                                                    <template v-if="promocion.nombre != 'Sin promocion'">
                                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivate(promocion.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </template>
                                                </template>
                                                <template v-else>  
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(promocion.id)">
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
                                        <label>nombre</label>
                                        <input class="form-control" v-model="nombre" name="nombre" rows="3" placeholder="Ingrese nombre"></input>
                                        <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" v-model="descripcion" name="descripcion" rows="3" placeholder="*Opcional*"></textarea>
                                        <span style="color:red" v-if="errors.descripcion">{{errors.descripcion[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha de inicio</label>
                                        <input type="date" v-model="fecha_inicio" class="form-control" name="fecha_inicio">
                                        <span style="color:red" v-if="errors.fecha_inicio">{{errors.fecha_inicio[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha fin</label>
                                        <input type="date" v-model="fecha_fin" class="form-control" name="fecha_fin">
                                        <span style="color:red" v-if="errors.fecha_fin">{{errors.fecha_fin[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_fin">Porcentaje</label>
                                        <input onkeypress="return event.charCode > 45" type="text" v-model="porcentaje" class="form-control" name="porcentaje">
                                        <span style="color:red" v-if="errors.porcentaje">{{errors.porcentaje[0]}}</span>
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
                //https://codeday.me/es/qa/20190626/919824.html
                id: 0,
                nombre: '',
                descripcion: '',
                fecha_inicio: '',
                fecha_fin: '',
                porcentaje: '',
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
                    case 'Modal_Promocion':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO DE PROMOCIONES";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN DE PROMOCIONES";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.fecha_fin = data['fecha_fin'];
                                this.porcentaje = data['porcentaje'];
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
                this.descripcion = '';
                this.fecha_inicio = '';
                this.fecha_fin = '';
                this.porcentaje = '';
                this.errors = [];
                swal(
                    'Promociones',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            myTable(){
                var dataT = $('#lista_promocion').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_promocion').DataTable({
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
                var url = '/promocion';
                axios.get(url).then(function (response) {
                    me.arrayPromocion = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            save(){
                let me = this;
                var url = '/promocion/save';
                axios.post(url,{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'porcentaje': this.porcentaje
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Promociones',
                        'Se ha registrado correctamente la promoción',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = '/promocion/update';
                axios.put(url,{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'fecha_inicio': this.fecha_inicio,
                    'fecha_fin': this.fecha_fin,
                    'porcentaje': this.porcentaje,
                    'id': this.id
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Unidad de medida',
                        'Se ha actualizado la unidad de medida correctamente',
                        'success'
                    )
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Promoción',
                    text: "¿Estás seguro de cambiar el estado de esta promoción?",
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
                        var url = '/promocion/activate';
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
                    title: 'Promoción',
                    text: "¿Estás seguro de cambiar el estado de esta promoción?",
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
                        var url = '/promocion/desactivate';
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
