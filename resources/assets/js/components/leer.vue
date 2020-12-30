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
                            <i class="fa fa-suitcase"></i> SERVICIO
                            <button type="button" @click="openModal('Modal_Servicio','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_servicio" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="servicio in arrayServicio" :key="servicio.id">
                                            <td v-text="servicio.nombre"></td>
                                            <td v-text="servicio.descripcion"></td>
                                            <td v-text="servicio.precio"></td>
                                            <td class="AD">
                                                <div v-if="servicio.estado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactivo</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <button type="button" @click="openModal('Modal_Servicio','update',servicio)"  class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                                </button> &nbsp;
                                                <template v-if="servicio.estado">  
                                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivate(servicio.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>  
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(servicio.id)">
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
                                        <input type="text" v-model="nombre" class="form-control" name="nombre" placeholder="Ingrese Nombre">
                                        <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea class="form-control" v-model="descripcion" name="descripcion" rows="3" placeholder="*Opcional*"></textarea>
                                        <span style="color:red" v-if="errors.descripcion">{{errors.descripcion[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input onkeypress="return event.charCode > 45" type="text" class="form-control" v-model="precio" name="precio" rows="3" placeholder="0.0"></input>
                                        <span style="color:red" v-if="errors.precio">{{errors.precio[0]}}</span>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal()">Cerrar <i class="fa fa-times-circle"></i></button>
                        <button type="button" v-if="tipoAccion==1" @click="save()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                        <button type="button" v-if="tipoAccion==2" @click="update()" class="btn btn-success">Guardar <i class="fa fa-check-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
        /**En la data, los campos que tengan el mismo nombre que la base de datos */
        data(){
            return{
                id: 0,
                nombre: '',
                descripcion: '',
                precio: '',
                arrayServicio: [], /**Arreglo donde vamos a obtener todos los datos */
                modal: 0, /**Nos va servir para activar el modal */
                tituloModal: "", /**El titulo del modal va cambiar para crear y actualizar */
                tipoAccion: 0,
                errors: [] /**Arreglo para meter los errores, esto para validaciones */
            }
        },
        methods: {
            /**Esta función recibe 3 parametros
             * modelo -> Uno que abre el modal, aunque se podría quitar el switch de modelo y solo dejar el switch de accion
             * accion -> el tipo, si va ser para crear o actualizar
             * data = [] -> cuando abramos el modal de actualización, se va mostrar la data en el formulario
             */
            openModal(modelo,accion,data = []){
                switch(modelo){
                    case 'Modal_Servicio':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO DE SERVICIOS";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN DE SERVICIOS";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.precio = data['precio'];
                                this.id = data['id'];
                            }
                        }
                    }
                }
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.descripcion = '';
                this.precio = '';
                this.errors = [];
                swal(
                    'Servicios',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            /**Función para que se muestre un datatable, aquí tienen que investigar un poco más de como mostrar datatables por medio de vue */
            myTable(){
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
            /**Muestra todos los datos */
            showList(){
                let me = this;
                var url = '/servicio'; /**Obtiene la ruta */
                axios.get(url).then(function (response) {
                    me.arrayServicio = response.data; /**Almacena la data en el arreglo */
                    me.myTable(); /**Llama a la función del datatable para que lo muestre */
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            save(){
                let me = this;
                var url = '/servicio/save'; /**Obtiene la ruta */
                /**En post cambia con el get, aquí le pasamos los parametros que obtenemos del formulario, sin pasarle el id, el id es autoincrementable */
                axios.post(url,{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'precio': this.precio
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Servicios',
                        'Se ha registrado correctamente el servicio',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422) /**Aquí obtenemos los errores de validación */
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = 'servicio/update'; /**Obtenemos la ruta */
                /**Es igual que post, pero aquí si le pasamos el id */
                axios.put(url,{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'precio': this.precio,
                    'id': this.id
                }).then(function (response){
                    me.closeModal();
                    me.showList();
                    swal(
                        'Servicios',
                        'Se ha actualizado correctamente el servicio',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Servicio',
                    text: "¿Estás seguro de cambiar el estado de este servicio?",
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
                        var url = '/servicio/activate';
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
                    title: 'Servicio',
                    text: "¿Estás seguro de cambiar el estado de este servicio?",
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
                        var url = '/servicio/desactivate';
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
