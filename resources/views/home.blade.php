@extends('layouts.adm-app')
@section('links')
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="/css/vuetify.min.css" rel="stylesheet">
@endsection
@section('style')
<style type="text/css" media="screen">
	[v-cloak] {
		display: none;
	}

	.content-height{
		height: 80vh !important;
	}
	html, body, .v-application, .v-application--wrap {
		min-height: -webkit-fill-available;
	}

	.v-application--wrap{
		min-height: 80vh !important;
	}
</style>
@endsection
@section('content')
<div id="app" v-cloak>
	<v-app style="height: 80vh !important;"> 
		<v-main style="height: 80vh !important;">
			<v-container style="height: 80vh !important;">
				<v-toolbar flat color="transparent" class="mb-4">
					<v-toolbar-title>USUARIOS</v-toolbar-title>
					<v-divider class="mx-4" inset vertical ></v-divider>
					<v-spacer></v-spacer>
					<v-btn color="dark" dark class="mr-2 mb-2" @click="openDialog()">ABRIR DIALOGO</v-btn>
					<v-btn color="dark" dark class="mb-2" @click="getData()">REFRESH </v-btn>
				</v-toolbar>

				<v-card class="mx-auto" max-width="700" outlined >
					<v-data-table
					:headers="headers"
					:items="items"
					:loading="loading"
					class="elevation-1"
					locale="es"
					{{-- :server-items-length="totalItems" --}}
					></v-data-table>
				</v-card>

				<v-dialog v-model="dialog" width="600px">
					<v-card>
						<v-card-title>
							<span class="headline">ESTO ES UN DIALOGO</span>
						</v-card-title>
						<v-card-text>
							<div class="inputs">
								<v-row>
									<v-col md="12">

										<v-card-title>Esto es un dialogo</v-card-title> 
									</v-col>
									<v-col md="12">
										<v-card class="mx-auto" outlined >
											<v-data-table
											:headers="headers"
											:items="items"
											:loading="loading"
											class="elevation-1"
											locale="es"
											{{-- :server-items-length="totalItems" --}}
											></v-data-table>
										</v-card>
									</v-col>
								</v-row>

							</div>  
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="red darken-1" class="white--text" @click="dialog = false">
								CANCELAR
							</v-btn>
							<v-btn color="green darken-1" class="white--text" @click="dialog = false">
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
<script src="/js/vuetify-es-lang.js"></script>
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
				image:null,
				items:[],
				totalItems:0,
				loading: false,                
				dialog: false,
				headers: [
				{
					text: 'ID',
					align: 'start',
					value: 'idusuario',
					sortable: false,
					filterable: false,
					width: '%1'
				},
				{
					text: 'NOMBRE',
					align: 'start',
					value: 'username',
					sortable: false,
					filterable: false,
					width: '%1'
				},
				]
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


			openDialog(){
				this.dialog=true;

			},

			getData() {
				var local = this;
				local.loading = true;
				axios.get('/get_usuarios',{})
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
		}
	})
</script>
@endsection
