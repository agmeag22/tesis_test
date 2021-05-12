@extends('layouts.adm-app')
@section('links')
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="/css/vuetify.min.css" rel="stylesheet">
<link href="/css/materialdesignicons.min.css" rel="stylesheet">
@endsection
@section('style')
<style>
	[v-cloak] {
		display: none;
	}

	.content-height{
		height: 86vh !important;
	}
	#app{
		width: 100%;
		height:100%;
		background-color: transparent;
	}

	.cst-container{
		width:100%;
		height: 100vh;
		display: flex;
		align-items: center;
		flex-direction: column;
		justify-content: space-around;
	}
</style>
@endsection
@section('content')
<div class="" id="app" v-cloak>
	<v-app> 
		<v-main>
			<v-container>
				<v-toolbar flat color="transparent" class="mb-4">
					<v-toolbar-title>Listado Subcategoria</v-toolbar-title>
					<v-divider class="mx-4" inset vertical ></v-divider>
					<v-spacer></v-spacer>
					<v-btn color="dark" dark class="mr-2 mb-2" @click="openDialog(-1)">Crear Subcategoria</v-btn>
					<v-btn color="dark" dark class="mb-2" @click="getData()">Buscar</v-btn>
				</v-toolbar>

				<v-card class="mx-auto" max-width="700" outlined >
					<v-data-table
					:headers="headers"
					:items="items"
					:loading="loading"
					class="elevation-1"
					locale="es"
					{{-- :server-items-length="totalItems" --}}
					><template v-slot:item.acciones="{item}">
						{{-- <center> --}}
							<template class="d-flex justify-center">
								<v-hover v-slot="{ hover }">
									<v-btn x-small color="blue" @click="openDialog(item)">
										<v-icon small color="white">mdi-pencil</v-icon>
										<span v-if="hover" class="white--text">Editar</span>
									</v-btn>
								</v-hover>
								<v-hover v-slot="{ hover }">
									<v-btn x-small color="red"  @click="openDeleteDialog(item)">
										<v-icon small color="white">mdi-delete</v-icon>
										<span v-if="hover" class="white--text">Eliminar</span>
									</v-btn>
								</v-hover>
							</template>
						{{-- </center> --}}
					</template></v-data-table>
				</v-card>

				<v-dialog v-model="dialogSubcategoria" width="600px">
					<v-card>
						<v-card-title>
							<span class="headline">Nueva Subcategoria</span>
						</v-card-title>
						<v-card-text>
							<div class="inputs">
								<v-form ref="form" v-model="valid" >
									<v-row class="d-flex justify-center">
										<v-col md="12">
											<v-card-subtitle>Complete la siguiente información, a continuación seleccion la categoria a la que corresponderá dicha subcategoria y coloque un nombre de la subcategoria</v-card-subtitle> 
										</v-col>
                                        <v-col md="12">
                                            <v-autocomplete
                                            :rules="[rules.required]"
                                            :items="categorias"
                                            label="Categoria"
                                            v-model="subcategoria.categoria"
                                            item-value="idcategoria"
                                            item-text="nombre"
                                            prepend-icon="mdi-store"
                                            :loading="loading"
                                            :search-input.sync="searchInput"
                                            @change="searchInput=''"
                                            ></v-autocomplete>
                                        </v-col>
                                        <v-col md="8">
                                            <v-text-field prepend-icon="mdi-account-box" label="Subcategoria" :rules="[rules.required,rules.mintext]" hide-details="auto" v-model="subcategoria.nombre"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </div>  
                        </v-card-text>
                        <v-card-actions>
                           <v-spacer></v-spacer>
                           <v-btn color="red darken-1" class="white--text" @click="dialogSubcategoria = false">
                              CANCELAR
                          </v-btn>
                          <v-btn color="green darken-1" class="white--text" @click="guardarSubcategoria()">
                              GUARDAR
                          </v-btn>
                      </v-card-actions>
                  </v-card>
              </v-dialog>

          </v-container>
      </v-main>
  </v-app>
</div>
@endsection
@section('scripts')
<script src="/js/vue.js"></script>
<script src="/js/vuetify.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/moment-with-locales.min.js"></script>
<script src="/js/vuetify-es-lang.js"></script>
<script src="/js/sweetalert2.js"></script>
<script src="/js/sweetalert.min.js"></script>

<!--vue-clipboard2@0.3.1-->
<script type="module">
	axios.defaults.headers.common = {
		"X-Requested-With": "XMLHttpRequest",
	};
	new Vue({
		"el": '#app',
		"vuetify": new Vuetify({
			"lang": {
				"locales": {es},
				"current": 'es',
			}
		}),
		data() {
			return {
                categorias:{},
                fechaInicio:null,
                mostrarFecha: false,
                subcategorias:[],
                subcategoria:{
                    nombre:"",
                    categoria:-1,
                },
                editedItem:{
                    id:-1,
                    item:{},
                },
                searchInput: "",
                items:[],
                totalItems:0,
                loading: false,
                nameRules: [
                v => !!v || 'El campo es requerido',
                ],
                rules: {
                    required: value => !!value || 'El campo es requerido.',
                    mintext: value => (value && value.length >= 3) || 'Se necesitan 3 caracteres minimo',
                },

                // rules: {
                //     required: v => !!v || 'Required.',
                // },
                valid: false,
                dialogSubcategoria: false,
                headers: [
                {
                	text: 'ID',
                	align: 'start',
                	value: 'idsubcategoria',
                	sortable: false,
                	filterable: false,
                	width: '100px'
                },
                {
                    text: 'CATEGORIA',
                    align: 'start',
                    value: 'categoria.nombre',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                	text: 'SUBCATEGORIA',
                	align: 'start',
                	value: 'nombre',
                	sortable: false,
                	filterable: false,
                	width: '100px'
                },
                {
                	text: 'ACCIONES',
                	align: 'center',
                	value: 'acciones',
                	sortable: false,
                	filterable: false,
                	width: '200px'
                },
                ],
            }
        },
        beforeMount() {
        	this.getData();
            this.getCategoria();
        },

        mounted() {
        },


        computed: {

        },
        watch: {
        },

        methods: {
        	selectFile() {
        		this.$refs.new_file.click();
        	},

        	openDialog(item){
        		if(item!=-1){
                    this.editedItem.item=item;
                    this.editedItem.id=item.idsubcategoria;
                    this.subcategoria.nombre=item.nombre;
                    this.subcategoria.categoria=item.categoria.idcategoria;
                }else{
                 this.editedItem.item={};
                 this.editedItem.id=-1;
                 this.subcategoria.nombre="";
                 this.subcategoria.categoria=null;
             }
             this.dialogSubcategoria=true;
         },

         openDeleteDialog(item){
            let local=this;
            this.editedItem.item=item;
            var formData = new FormData();
            formData.append("idsubcategoria", item.idsubcategoria);
            swal({
                title: 'Está seguro de esta acción?',
                text: "Eliminar elemento de la lista",
                icon: 'warning',
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post(`/administration/iudop/secret/subcategoria/delete_subcategoria`,formData)
                    .then((response) => {
                        local.items.splice(local.items.indexOf(local.editedItem.item),1);
                        swal({
                            title:'Borrado Exitoso',
                            text:'El elemento ha sido eliminado',
                            icon:'success'
                        });
                        local.dialogDelete=false;
                    })
                    .catch(function (error) {
                        window.console.log(error);
                        if (error.response) {
                            window.console.log(error.response);
                            if (error.response.status == 401) {
                                location.reload();
                            }
                        }
                    })
                }  
            });
        },

        cstSwal(message1,message2) {
            swal({
                title: message1,
                buttons: {
                    cancel: false,
                    confirm: true,
                },
            });
        },

        getCategoria() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/categoria/get_categoria',{})
            .then(function (response) {
                local.categorias = response.data;
                local.loading = false;
            })
            .catch(function (error) {
                local.loading = false;
                window.console.log(error);
                if (error.response) {
                    window.console.log(error.response);
                    if (error.response.status == 401) {
                        location.reload();
                    }
                }
            })
        },

        getData() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/subcategoria/get_subcategoria',{})
            .then(function (response) {
                local.items = response.data;
                local.loading = false;
            })
            .catch(function (error) {
                local.loading = false;
                window.console.log(error);
                if (error.response) {
                    window.console.log(error.response);
                    if (error.response.status == 401) {
                        location.reload();
                    }
                }
            })
        },

        guardarSubcategoria() {
          this.$refs.form.validate();
          if (this.valid) {
             var formData = new FormData();
             formData.append("nombre", this.subcategoria.nombre);
             formData.append("categoria", this.subcategoria.categoria);
             formData.append("idsubcategoria", this.editedItem.id);
             var local = this;
             local.cstSwal('Guardando...','');
             axios.post('/administration/iudop/secret/subcategoria/save_subcategoria', formData)
             .then(function (response) {
                local.cstSwal('Guardado con exito','Los cambios han sido aplicados');
                console.log(response.data);
                local.dialogSubcategoria=false;
                if(local.editedItem.id==-1){
                   local.items.push(response.data);
               }else{
                   local.items.splice(local.items.indexOf(local.editedItem.item),1,response.data);
               }
               swal.close();
           }).catch(function (error) {
            local.cstSwal('Error','Intente de nuevo');
            console.log(error);
        });
       }
   }, 
}
})
</script>
@endsection
