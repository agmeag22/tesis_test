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
                    <v-toolbar-title>Listado Indice</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical ></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn color="dark" dark class="mr-2 mb-2" @click="openDialog(-1)">Crear Indice</v-btn>
                    <v-btn color="dark" dark class="mb-2" @click="getData()">Buscar</v-btn>
                </v-toolbar>
                <v-row>
                   <v-col md="2">
                    <v-text-field prepend-icon="mdi-account" label="Buscar Indice" v-model="options.filters.search"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-card class="mx-auto" outlined >
                <v-data-table
                :headers="headers"
                :items="items"
                :loading="loading"
                class="elevation-1"
                locale="es"
                {{-- :server-items-length="totalItems" --}}
                >
                <template v-slot:item.acciones="{item}">
                    {{-- <center> --}}
                        <template class="d-flex justify-center">
                            <v-hover v-slot="{ hover }">
                                <v-btn x-small color="blue" @click="openDialogPreview(item)">
                                    <v-icon small color="white">mdi-eye</v-icon>
                                    <span v-if="hover" class="white--text">Ver</span>
                                </v-btn>
                            </v-hover>

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

            <v-dialog v-model="dialogIndice" width="600px" persistent>
                <v-card>
                    <v-card-title>
                        <span class="headline">Nuevo Indice</span>
                    </v-card-title>
                    <v-card-text>
                        <div class="inputs">
                            <v-form ref="form" v-model="valid" >
                                <v-row class="d-flex justify-center">
                                    <v-col cols="12">
                                        <v-card-subtitle>Complete la siguiente información, a continuación coloque las siguientes partes del Indice: Informe, número de pregunta, número de subpregunta, categoria, subcategoria</v-card-subtitle> 
                                    </v-col>
                                    <v-row>
                                        <v-col cols="4">
                                            <v-autocomplete
                                            :rules="[rules.required]"
                                            :items="informes"
                                            label="# de informe"
                                            v-model="indice.idinforme"
                                            item-value="idinforme"
                                            item-text="idinforme"
                                            prepend-icon="mdi-store"
                                            :loading="loading"
                                            :search-input.sync="searchInput"
                                            @change="searchInput=''"
                                            type="number"
                                            ></v-autocomplete>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-text-field prepend-icon="mdi-account-box" label="# de Pregunta" :rules="[rules.required]" type="number"hide-details="auto" v-model="indice.idpregunta"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-text-field prepend-icon="mdi-account-box" label="# de Subpregunta" type="number"hide-details="auto" v-model="indice.idsubpregunta"></v-text-field>
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col cols="6">
                                            <v-autocomplete
                                            :rules="[ruleCategorias]"
                                            :items="categorias"
                                            label="Categoria"
                                            v-model="indice.idcategoria"
                                            item-value="idcategoria"
                                            item-text="nombre"
                                            prepend-icon="mdi-store"
                                            :loading="loading"
                                            :search-input.sync="searchCategoria"
                                            @change="searchCategoria=''"
                                            ></v-autocomplete>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-autocomplete
                                            :rules="[ruleCategorias]"
                                            :items="subcategorias"
                                            label="Subcategoria"
                                            v-model="indice.idsubcategoria"
                                            item-value="idsubcategoria"
                                            item-text="nombre"
                                            prepend-icon="mdi-store"
                                            :loading="loading"
                                            :search-input.sync="searchSubcategoria"
                                            @change="searchSubcategoria=''"
                                            ></v-autocomplete>
                                            
                                        </v-col>
                                    </v-row>
                                    

                                </v-row>
                            </v-col>
                        </v-row>
                    </v-form>
                </div>  
            </v-card-text>
            <v-card-actions>
             <v-spacer></v-spacer>
             <v-btn color="red darken-1" class="white--text" @click="dialogIndice = false">
              CANCELAR
          </v-btn>
          <v-btn color="green darken-1" class="white--text" @click="guardarIndice()">
              GUARDAR
          </v-btn>
      </v-card-actions>
  </v-card>
</v-dialog>
<v-dialog v-model="dialogPreview" width="600px">
    <v-card>
        <v-card-title>
            <span class="headline">Nuevo Indice</span>
        </v-card-title>
        <v-card-text>
            <div class="inputs">
                <v-form ref="form" v-model="valid" >
                    <v-row class="d-flex justify-center">
                        <v-col cols="12">
                            <v-card-subtitle>Complete la siguiente información, a continuación coloque las siguientes partes del Indice: Informe, número de pregunta, número de subpregunta, categoria, subcategoria</v-card-subtitle> 
                        </v-col>
                        <v-row>
                            <v-col cols="12">
                                Informe
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.numero" label="# Informe" outlined readonly ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.titulo"  label="Titulo" outlined readonly ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.descripcion"  label="Descripcion" outlined readonly ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.enlace"  label="Url" outlined readonly ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.fechaInicio"  label="Fecha Inicio" outlined readonly ></v-text-field>
                            </v-col>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.informe.fechaFin"  label="Fecha Fin" outlined readonly ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.pregunta" label="# Pregunta" outlined readonly ></v-text-field>
                            </v-col>
                            <template v-if="indiceView.subpregunta">
                                <v-col cols="4">
                                    <v-text-field v-model="indiceView.subpregunta"  label="# Subpregunta" outlined readonly ></v-text-field>
                                </v-col>
                            </template>
                            <v-col cols="4">
                                <v-text-field v-model="indiceView.categoria"  label="Categoria" outlined readonly ></v-text-field>
                            </v-col>
                            <template v-if="indiceView.subcategoria">
                                <v-col cols="4">
                                    <v-text-field v-model="indiceView.subcategoria"  label="Subcategoria" outlined readonly ></v-text-field>
                                </v-col>
                            </template>
                        </v-row>


                    </v-row>
                </v-col>
            </v-row>
        </v-form>
    </div>  
</v-card-text>
<v-card-actions>
 <v-spacer></v-spacer>
 <v-btn color="red darken-1" class="white--text" @click="dialogPreview = false">
  Cerrar
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
                informes:[],
                searchInput:null,
                dialogPreview:false,
                idmatch:null,
                options:{   
                    filters: {
                        search: null,
                    },
                },
                categorias:[],
                subcategorias:[],
                indices:[],
                indice:{
                    idinforme:null,
                    idpregunta:null,
                    idsubpregunta:null,
                    idcategoria:null,
                    idsubcategoria:null,
                },
                indiceView:{
                    informe:{
                        numero:"",
                        titulo:"",
                        descripcion:"",
                        enlace:"",
                        fechaInicio:"",
                        fechaFin:"",
                    },
                    pregunta:"",
                    subpregunta:"",
                    categoria:"",
                    subcategoria:"",
                },
                editedItem:{
                    id:-1,
                    item:{},
                },
                searchCategoria: "",
                searchSubcategoria:"",
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
                dialogIndice: false,
                headers: [
                {
                    text: 'ID',
                    align: 'start',
                    value: 'idindice',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: '# informe',
                    align: 'start',
                    value: 'informe.idinforme',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: '# pregunta',
                    align: 'start',
                    value: 'pregunta.num_pregunta',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: '# subpregunta',
                    align: 'start',
                    value: 'subpregunta.num_subpregunta',
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
                    value: 'subcategoria.nombre',
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
            this.getCategorias();
            this.getSubcategorias();
            this.getInforme();
        },

        mounted() {
        },


        computed: {

        },
        watch: {
            // 'informe.fechaInicio': function (newvalue, oldvalue) {
            //     if (newvalue && newvalue != oldvalue) {
            //         let string=newvalue.split("-");
            //         string=string[2]+"/"+string[1]+"/"+string[0];
            //         this.informe.fechaInicio=string;
            //     }
            // },
            'indice.idcategoria': function (newvalue, oldvalue) {
                if (newvalue && newvalue != oldvalue) {
                    if(newvalue!=this.idmatch){
                        this.indice.idsubcategoria=null;
                    }
                }
            },
            'indice.idsubcategoria': function (newvalue, oldvalue) {
                if (newvalue && newvalue != oldvalue) {
                    this.getCategoria();
                }
            },
        },

        methods: {

            ruleCategorias(){
                if(!this.indice.idcategoria && !this.indice.idsubcategoria){
                    return 'Una debe ser seleccionada';
                }
                return true;
            },

            selectFile() {
                this.$refs.new_file.click();
            },

            openDialogPreview(item){
                this.dialogPreview=true;
                this.indiceView.informe.numero=item.informe.idinforme?item.informe.idinforme:"";
                this.indiceView.informe.titulo=item.informe.titulo?item.informe.titulo:"";
                this.indiceView.informe.descripcion=item.informe.descripcion?item.informe.descripcion:"";
                this.indiceView.informe.enlace=item.informe.url_informe?item.informe.url_informe:"";
                this.indiceView.informe.fechaInicio=item.informe.fecha_inicio?item.informe.fecha_inicio:"";
                this.indiceView.informe.fechaFin=item.informe.fecha_fin?item.informe.fecha_fin:"";
                this.indiceView.pregunta=item.pregunta.num_pregunta?item.pregunta.num_pregunta:"";                    
                this.indiceView.subpregunta=item.subpregunta?item.subpregunta.num_subpregunta:"";
                this.indiceView.categoria=item.categoria.nombre?item.categoria.nombre:"";
                this.indiceView.subcategoria=item.subcategoria?item.subcategoria.nombre:"";
            },

            openDialog(item){
                if(this.$refs.form) this.$refs.form.resetValidation();
                this.idmatch=null;
                if(item!=-1){
                    this.editedItem.item=item;
                    this.editedItem.id=item.idindice;
                    this.indice.idinforme=item.informe.idinforme;
                    this.indice.idpregunta=item.pregunta.idpregunta;
                    this.indice.idsubpregunta=item.subpregunta?item.subpregunta.num_subpregunta:null;
                    this.indice.idcategoria=item.categoria.idcategoria;
                    this.indice.idsubcategoria=item.subcategoria?item.subcategoria.idsubcategoria:null;
                }else{
                   this.editedItem.item={};
                   this.editedItem.id=-1;
                   this.indice.idinforme=null;
                   this.indice.idpregunta=null;
                   this.indice.idsubpregunta=null;
                   this.indice.idcategoria=null;
                   this.indice.idsubcategoria=null;
               }
               this.dialogIndice=true;
           },

           openDeleteDialog(item){
            let local=this;
            this.editedItem.item=item;
            var formData = new FormData();
            formData.append("id", item.id);
            swal({
                title: 'Está seguro de esta acción?',
                text: "Eliminar elemento de la lista",
                icon: 'warning',
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.post(`/administration/iudop/secret/indice/delete_indice`,formData)
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

        getData() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/indice/get_indice',{})
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

        guardarIndice() {
            var local = this;
            var formData = new FormData();
            this.$refs.form.validate();
            if (this.valid) {
                formData.append("idindice", this.editedItem.id);
                formData.append("idinforme", this.indice.idinforme);
                formData.append("idpregunta", this.indice.idpregunta);
                formData.append("idsubpregunta", this.indice.idsubpregunta!=null? this.indice.idsubpregunta:-1);
                formData.append("idcategoria", this.indice.idcategoria);
                (this.indice.idsubcategoria!=null)? formData.append("idsubcategoria", this.indice.idsubcategoria):formData.append("idsubcategoria", -1);
                local.cstSwal('Guardando...','');
                axios.post('/administration/iudop/secret/indice/save_indice', formData)
                .then(function (response) {
                    local.cstSwal('Guardado con exito','Los cambios han sido aplicados');
                    console.log(response.data);
                    local.dialogIndice=false;
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
        getCategorias() {
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

        getInforme() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/informe/get_informe',{})
            .then(function (response) {
                local.informes = response.data;
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

        getCategoria() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/subcategoria/get_categoriabysub',
            {
                params: {
                    idsubcategoria:local.indice.idsubcategoria
                }
            })
            .then(function (response) {
                local.indice.idcategoria = response.data;
                local.idmatch= response.data;
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
        getSubcategorias() {
            var local = this;
            local.loading = true;
            axios.get('/administration/iudop/secret/subcategoria/get_subcategoria',{})
            .then(function (response) {
                local.subcategorias = response.data;
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
    }
})
</script>
@endsection
