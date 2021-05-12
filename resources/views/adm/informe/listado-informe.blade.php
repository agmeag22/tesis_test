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
                    <v-toolbar-title>Listado Informe</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical ></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn color="dark" dark class="mr-2 mb-2" @click="openDialog(-1)">Crear Informe</v-btn>
                    <v-btn color="dark" dark class="mb-2" @click="getData()">Buscar</v-btn>
                </v-toolbar>
                <v-row>
                 <v-col md="2">
                    <v-text-field prepend-icon="mdi-account" label="Buscar Informe" v-model="options.filters.search"
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
                <template v-slot:item.url="{item}">
                    <a :href="item.url_informe" target="_blank">@{{item.url_informe}}</a>
                </template>
                <template v-slot:item.acciones="{item}">
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

            <v-dialog v-model="dialogInforme" width="600px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Nuevo Informe</span>
                    </v-card-title>
                    <v-card-text>
                        <div class="inputs">
                            <v-form ref="form" v-model="valid" >
                                <v-row class="d-flex justify-center">
                                    <v-col cols="12">
                                        <v-card-subtitle>Complete la siguiente información, a continuación coloque las siguientes partes del informe: título, descripción, período del informe y url de enlace a página web del documento</v-card-subtitle> 
                                    </v-col>
                                    <v-col cols="8">
                                        <v-text-field prepend-icon="mdi-account-box" label="Título Informe" :rules="[rules.required,rules.mintext]" hide-details="auto" v-model="informe.nombre"></v-text-field>
                                    </v-col>
                                    <v-col cols="8">
                                        <v-textarea outlined
                                        label="Descripción"
                                        v-model="informe.descripcion"
                                        :rules="[rules.required,rules.mintext]"
                                        ></v-textarea>
                                    </v-col>
                                    <v-col cols="8">
                                        <v-text-field prepend-icon="mdi-account-box" label="# de informe" :rules="[rules.required]" type="number"hide-details="auto" v-model="informe.numero"></v-text-field>
                                    </v-col>
                                    <v-col cols="8">
                                        <v-text-field prepend-icon="mdi-account-box" label="Url de Informe" :rules="[rules.required,rules.mintext]" hide-details="auto" v-model="informe.url"></v-text-field>
                                    </v-col>
                                    <v-col cols="8">
                                        <v-row>
                                            <v-col cols="6">
                                                <v-menu
                                                ref="mostrarFechaInicio"
                                                v-model="mostrarFechaInicio"
                                                :close-on-content-click="false"
                                                :return-value.sync="informe.fechaInicio"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                                >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-row>
                                                        <v-col cols="12">
                                                            <v-text-field
                                                            v-model="informe.fechaInicio"
                                                            label="Fecha Inicio"
                                                            prepend-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            ></v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </template>
                                                <v-date-picker v-model="informe.fechaInicio" no-title scrollable :range="false">
                                                    <v-spacer></v-spacer>
                                                    <v-btn text color="primary" @click="mostrarFechaInicio = false">Cancel</v-btn>
                                                    <v-btn text color="primary" @click="$refs.mostrarFechaInicio.save(informe.fechaInicio)">OK</v-btn>
                                                </v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="6">
                                            <v-menu
                                            ref="mostrarFechaFin"
                                            v-model="mostrarFechaFin"
                                            :close-on-content-click="false"
                                            :return-value.sync="informe.fechaFin"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="290px"
                                            >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-row>
                                                    <v-col cols="12">
                                                        <v-text-field
                                                        v-model="informe.fechaFin"
                                                        label="Fecha Fin"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        ></v-text-field>
                                                    </v-col>
                                                </v-row>
                                            </template>
                                            <v-date-picker v-model="informe.fechaFin" no-title scrollable :range="false">
                                                <v-spacer></v-spacer>
                                                <v-btn text color="primary" @click="mostrarFechaFin = false">Cancel</v-btn>
                                                <v-btn text color="primary" @click="$refs.mostrarFechaFin.save(informe.fechaFin)">OK</v-btn>
                                            </v-date-picker>
                                        </v-menu>
                                    </v-col>

                                </v-row>
                            </v-col>
                        </v-row>
                    </v-form>
                </div>  
            </v-card-text>
            <v-card-actions>
               <v-spacer></v-spacer>
               <v-btn color="red darken-1" class="white--text" @click="dialogInforme = false">
                  CANCELAR
              </v-btn>
              <v-btn color="green darken-1" class="white--text" @click="guardarInforme()">
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
                options:{   
                    filters: {
                        search: null,
                    },
                },
                menu: false,
                mostrarFechaInicio:false,
                mostrarFechaFin:false,
                informes:[],
                informe:{
                    nombre:"",
                    descripcion:"",
                    numero:null,
                    url:"",
                    fechaInicio:null,
                    fechaFin:null,
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
                dialogInforme: false,
                headers: [
                {
                    text: 'ID',
                    align: 'start',
                    value: 'id',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: '# INFORME',
                    align: 'start',
                    value: 'idinforme',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: 'TITULO',
                    align: 'start',
                    value: 'titulo',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: 'URL',
                    align: 'start',
                    value: 'url',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: 'DESCRIPCION',
                    align: 'start',
                    value: 'descripcion',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: 'FECHA INICIO',
                    align: 'start',
                    value: 'fecha_inicio',
                    sortable: false,
                    filterable: false,
                    width: '100px'
                },
                {
                    text: 'FECHA FIN',
                    align: 'start',
                    value: 'fecha_fin',
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
            // 'informe.fechaFin': function (newvalue, oldvalue) {
            //     if (newvalue && newvalue != oldvalue) {
            //         let string=newvalue.split("-");
            //         string=string[2]+"/"+string[1]+"/"+string[0];
            //         this.informe.fechaFin=string;
            //     }
            // },
        },

        methods: {
            selectFile() {
                this.$refs.new_file.click();
            },

            openDialog(item){
                if(item!=-1){
                    this.editedItem.item=item;
                    this.editedItem.id=item.id;
                    this.informe.numero=item.idinforme;
                    this.informe.nombre=item.titulo;
                    this.informe.url=item.url_informe;
                    this.informe.descripcion=item.descripcion;
                    this.informe.fechaInicio=item.fecha_inicio;
                    this.informe.fechaFin=item.fecha_fin;
                }else{
                 this.editedItem.item={};
                 this.editedItem.id=-1;
                 this.informe.numero=null;
                 this.informe.nombre="";
                 this.informe.url="";
                 this.informe.descripcion="";
                 this.informe.fechaInicio=null;
                 this.informe.fechaFin=null;
             }
             this.dialogInforme=true;
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
                    axios.post(`/administration/iudop/secret/informe/delete_informe`,formData)
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
            axios.get('/administration/iudop/secret/informe/get_informe',{params: local.options.filters})
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

        guardarInforme() {
          this.$refs.form.validate();
          if (this.valid) {
             var formData = new FormData();
             formData.append("id", this.editedItem.id);
             formData.append("idinforme", this.informe.numero);
             formData.append("titulo", this.informe.nombre);
             formData.append("descripcion", this.informe.descripcion);
             formData.append("url", this.informe.url);
             formData.append("fechaInicio", this.informe.fechaInicio);
             formData.append("fechaFin", this.informe.fechaFin);
             var local = this;
             local.cstSwal('Guardando...','');
             axios.post('/administration/iudop/secret/informe/save_informe', formData)
             .then(function (response) {
                local.cstSwal('Guardado con exito','Los cambios han sido aplicados');
                console.log(response.data);
                local.dialogInforme=false;
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
