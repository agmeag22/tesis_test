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
					<v-toolbar-title>Listado Categoria</v-toolbar-title>
					<v-divider class="mx-4" inset vertical ></v-divider>
					<v-spacer></v-spacer>
					<v-btn color="dark" dark class="mr-2 mb-2" @click="openDialog(-1)">Crear Categoria</v-btn>
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

				<v-dialog v-model="dialogCategoria" width="600px">
					<v-card>
						<v-card-title>
							<span class="headline">Nueva Categoria</span>
						</v-card-title>
						<v-card-text>
							<div class="inputs">
								<v-form ref="form" v-model="valid" >
									<v-row class="d-flex justify-center">
										<v-col md="12">
											<v-card-subtitle>Complete la siguiente información, a continuación colocar un titulo a la categoria</v-card-subtitle> 
										</v-col>
										<v-col md="8">
											<v-text-field prepend-icon="mdi-account-box" label="Titulo Categoria" :rules="[rules.required,rules.mintext]" hide-details="auto" v-model="categoria.nombre"></v-text-field>
										</v-col>
                                   </v-row>
                               </v-form>
                           </div>  
                       </v-card-text>
                       <v-card-actions>
                           <v-spacer></v-spacer>
                           <v-btn color="red darken-1" class="white--text" @click="dialogCategoria = false">
                              CANCELAR
                          </v-btn>
                          <v-btn color="green darken-1" class="white--text" @click="guardarCategoria()">
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
                fechaInicio:null,
                mostrarFecha: false,
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
                dialogCategoria: false,
                headers: [
                {
                	text: 'ID',
                	align: 'start',
                	value: 'idcategoria',
                	sortable: false,
                	filterable: false,
                	width: '100px'
                },
                {
                	text: 'NOMBRE CATEGORIA',
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
                idempresa: null,
                categorias:[],
                categoria:{
                    nombre:"",
                },
                empresa:"",
            }
        },
        beforeMount() {
        	this.getData();
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
        			this.editedItem.id=item.idcategoria;
        			this.editedItem.item=item;
        			this.categoria.nombre=item.nombre;
        		}else{
        			this.editedItem.item={};
        			this.editedItem.id=-1;
        			this.categoria.nombre="";
        		}
        		this.dialogCategoria=true;
        	},

        	openDeleteDialog(item){
                let local=this;
        		var formData = new FormData();
        		formData.append("idcategoria", item.idcategoria);
        		swal({
        			title: 'Está seguro de esta acción?',
        			text: "Eliminar elemento de la lista",
        			buttons: {
                        cancel: true,
                        confirm: true,
                    },
                })
        		.then((willDelete) => {
        			if (willDelete) {
        				axios.post(`/administration/iudop/secret/categoria/delete_categoria`,formData)
        				.then((response) => {
        					local.items.splice(local.items.indexOf(item),1);
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

        	getData() {
        		var local = this;
        		local.loading = true;
        		axios.get('/administration/iudop/secret/categoria/get_categoria',{})
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

        	guardarCategoria() {
        		this.$refs.form.validate();
        		if (this.valid) {
        			var formData = new FormData();
        			formData.append("nombre", this.categoria.nombre);
        			formData.append("idcategoria", this.editedItem.id);
        			var local = this;
        			local.cstSwal('Guardando...','');
        			axios.post('/administration/iudop/secret/categoria/save_categoria', formData)
        			.then(function (response) {
        				local.cstSwal('Guardado con exito','Los cambios han sido aplicados');
        				console.log(response.data);
        				local.dialogCategoria=false;
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
