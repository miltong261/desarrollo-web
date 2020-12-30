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
                            <i class="fa fa-users"></i> USUARIOS
                            <button type="button" @click="openModal('Modal_User','save')" class="btn btn-info">
                                <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                <table id="lista_user" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo electrónico</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in arrayUser" :key="user.id">
                                            <td v-text="user.name"></td>
                                            <td v-text="user.email"></td>
                                            <td v-text="user.nombre_rol"></td>
                                            <td class="AD">
                                                <div v-if="user.estado">
                                                    <span class="badge badge-success w"><i class="fa fa-check-circle"></i> Activo</span>
                                                </div>
                                                <div v-else>
                                                    <span class="badge badge-danger w"><i class="fa fa-times-circle"></i> Inactivo</span>
                                                </div>
                                            </td>
                                            <td class="AD">
                                                <template v-if="user.estado === 1">
                                                    <button type="button" @click="openModal('Modal_User','update',user)"  class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    </button> &nbsp;
                                                </template>
                                                <template v-if="user.estado">  
                                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivate(user.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>  
                                                    <button type="button" class="btn btn-info btn-sm" @click="activate(user.id)">
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
                                        <input class="form-control" v-model="name" name="name" rows="3" placeholder="Ingrese nombre"></input>
                                        <span style="color:red" v-if="errors.name">{{errors.name[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Correo electrónico</label>
                                        <input type="email" class="form-control" v-model="email" name="email" rows="3" placeholder="Ingrese correo electrónico"></input>
                                        <span style="color:red" v-if="errors.email">{{errors.email[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control" v-model="password" name="name" rows="3"></input>
                                        <span style="color:red" v-if="errors.password">{{errors.password[0]}}</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Roles</label>
                                        <select class="form-control" v-model="id_rol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                        </select>
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
                id_rol: 0,
                name: '',
                email: '',
                password: '',
                nombre_rol: '',
                arrayUser: [],
                arrayRol: [],
                modal: 0,
                tituloModal: "",
                tipoAccion: 0,
                errors: []
            }
        },
        methods: {
            openModal(modelo,accion,data = []){
                switch(modelo){
                    case 'Modal_User':{
                        switch(accion){
                            case 'save':{
                                this.modal = 1;
                                this.tituloModal = "REGISTRO DE USUARIOS";
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':{
                                this.modal = 1;
                                this.tituloModal = "ACTUALIZACIÓN USUARIOS";
                                this.tipoAccion = 2;
                                this.id_rol = data['id_rol'];
                                this.name = data['name'];
                                this.email = data['email'];
                                this.id = data['id'];
                                break;
                            }
                        }
                    }
                }
                this.showRol();
            },
            closeModal(){
                this.modal = 0;
                this.tituloModal = 0;
                this.id_rol = 0;
                this.name = '';
                this.email = '';
                this.password = ''; 
                this.errors = [];
                swal(
                    'Usuarios',
                    'Se ha cancelado la operación correctamente',
                    'error'
                )
            },
            myTable(){
                var dataT = $('#lista_user').DataTable();
                dataT.destroy();
                this.$nextTick(function() {
                    $('#lista_user').DataTable({
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
                var url = '/users';
                axios.get(url).then(function (response) {
                    me.arrayUser = response.data;
                    me.myTable();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            showRol(){
               let me = this;
               var url = '/rol/selectRol';
                axios.get(url).then(function (response) {
                    me.arrayRol = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            save(){
                let me = this;
                var url = '/users/save';
                axios.post(url,{
                    'id_rol': this.id_rol,
                    'name': this.name,
                    'email': this.email,
                    'password': this.password
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Usuarios',
                        'Se ha registrado correctamente el usuario',
                        'success'
                    )
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            update(){
                let me = this;
                var url = '/users/update';
                axios.put(url,{
                    'id_rol': this.id_rol,
                    'name': this.name,
                    'email': this.email,
                    'password': this.password,
                    'id': this.id
                }).then(function (response) {
                    me.closeModal();
                    me.showList();
                    swal(
                        'Usuarios',
                        'Se ha actualizado el usuario correctamente',
                        'success'
                    )
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors;
                });
            },
            activate(id){
                swal({
                    title: 'Usuarios',
                    text: "¿Estás seguro de cambiar el estado de este usuario?",
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
                        var url = '/users/activate';
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
                    title: 'Usuarios',
                    text: "¿Estás seguro de cambiar el estado de este usuario?",
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
                        var url = '/users/desactivate';
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
