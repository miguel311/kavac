<template>
	<div class="card">
		<div class="card-header">
			<h6 class="card-title text-uppercase">Solicitud de Bienes Institucionales</h6>
			<div class="card-btns">
				<a href="#" class="btn btn-sm btn-primary btn-custom" @click="redirect_back(route_list)" 
				   title="Ir atrás" data-toggle="tooltip">
					<i class="fa fa-reply"></i>
				</a>
				<a href="#" class="card-minimize btn btn-card-action btn-round" title="Minimizar" 
				   data-toggle="tooltip">
					<i class="now-ui-icons arrows-1_minimal-up"></i>
				</a>
			</div>
		</div>
		<div class="card-body">
			<div class="alert alert-danger" v-if="errors.length > 0">
				<div class="container">
					<div class="alert-icon">
						<i class="now-ui-icons objects_support-17"></i>
					</div>
					<strong>Cuidado!</strong> Debe verificar los siguientes errores antes de continuar:
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"
							@click.prevent="errors = []">
						<span aria-hidden="true">
							<i class="now-ui-icons ui-1_simple-remove"></i>
						</span>
					</button>
					<ul>
						<li v-for="error in errors">{{ error }}</li>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4" v-if="record.id">
				    <div class="form-group">
				        <label>Fecha de Solicitud</label>
				        <div class="input-group input-sm">
                        	<span class="input-group-addon">
                            	<i class="now-ui-icons ui-1_calendar-60"></i>
                        	</span>
                        	<input  type="text" class="form-control input-sm"
                        			data-toogle="tooltip"
                        			title="Fecha de la solicitud" v-model="record.created_at"
                        			disabled="true">
                    	</div>
				    </div>
				</div>
				<div class="col-md-4">
			        <div class="form-group is-required">
			            <label>Fecha de Entrega</label>
			            <div class="input-group input-sm">
			                <span class="input-group-addon">
								<i class="now-ui-icons ui-1_calendar-60"></i>
			                </span>
			                <input  type="date" class="form-control input-sm" 
			                		data-toogle="tooltip" 
                        			title="Indique la fecha de entrega de los equipos"
                        			v-model="record.delivery_date">
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4">
					<div class="form-group is-required">
						<label>Tipo de Solicitud</label>
						<select2 :options="types" 
								 v-model="record.type_id"></select2>
					</div>
				</div>
				<div class="col-md-4">
				    <div class="form-group is-required">
				        <label>Motivo de la solicitud</label>
				        <textarea  data-toggle="tooltip" 
								   title="Indique el motivo de la solicitud" 
								   class="form-control input-sm" v-model="record.motive">
					   </textarea>
				    </div>
				</div>
			</div>
			<div v-if="record.type_id > 1">
				<div class="row"style="margin: 10px 0">
					<div class="col-md-12">
						<b>Ubicación</b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group is-required">
							<label>Pais:</label>
							<select2 :options="countries" id="country_select"
									 @input="getEstates()"
									 v-model="record.country_id"></select2>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group is-required">
							<label>Estado:</label>
							<select2 :options="estates" id="estate_select"
									@input="getMunicipalities()"
									:disabled="(!this.record.country_id != '')"
									v-model="record.estate_id"></select2>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group is-required">
							<label>Municipio:</label>
							<select2 :options="municipalities" id="municipality_select"
									@input="getParishes()"
									:disabled="(!this.record.estate_id != '')"
									v-model="record.municipality_id"></select2>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group is-required">
							<label>Parroquia:</label>
							<select2 :options="parishes" id="parish_select"
									 :disabled="(!this.record.municipality_id != '')"
									 v-model="record.parish_id"></select2>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group is-required">
							<label>Dirección</label>
							<textarea  data-toggle="tooltip" 
									   title="Indique dirección física del bien" 
									   class="form-control" v-model="record.address">
						   </textarea>
						</div>
					</div>
					
				</div>
			</div>
			<div v-show="record.type_id == 3">
				<div class="row"style="margin: 10px 0">
					<div class="col-md-12">
						<b>Información de Contacto</b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group is-required">
					        <label>Nombre del Agente Externo</label>
					        <input  type="text" class="form-control input-sm"
					        		data-toogle="tooltip" 
	                        		title="Indique el nombre del agente externo responsable del bien" v-model="record.agent_name">
					    </div>
					</div>
					
					<div class="col-md-4">
					    <div class="form-group is-required">
					    	<label>Teléfono del Agente Externo</label>
					    	<input  type="text" class="form-control input-sm"
					    			data-toogle="tooltip" 
	                        		title="Indique el teléfono del agente externo responsable del bien" v-model="record.agent_telf">
					    </div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group is-required">
					    	<label>Correo del Agente Externo</label>
					    	<input  type="text" class="form-control input-sm"
					    			data-toogle="tooltip" 
	                        		title="Indique el correo eléctronico del agente externo responsable del bien"
	                        		v-model="record.agent_email">
					    </div>
					</div>
				</div>
			</div>

			<hr>
			<div class="form-group form-inline pull-right VueTables__limit-2">
				<div class="VueTables__limit-field">
					<label class="">Registros</label>
					<select2 :options="perPageValues"
						v-model="perPage">
					</select2>
				</div>
			</div>
			<v-client-table @row-click="toggleActive" :columns="columns" :data="records" :options="table_options" ref="tableMax">
				<div slot="h__check" class="text-center">
					<label class="form-checkbox">
						<input type="checkbox" v-model="selectAll" @click="select()" class="cursor-pointer">
					</label>
				</div>

				<div slot="check" slot-scope="props" class="text-center">
					<label class="form-checkbox">
						<input type="checkbox" class="cursor-pointer" :value="props.row.id" :id="'checkbox_'+props.row.id" v-model="selected">
					</label>
				</div>
				<div slot="condition" slot-scope="props" class="text-center">
					<span>{{ (props.row.asset_condition)? props.row.asset_condition.name:props.row.asset_condition_id }}</span>
				</div>
				<div slot="status" slot-scope="props" class="text-center">
					<span>{{ (props.row.asset_status)? props.row.asset_status.name:props.row.asset_status_id }}</span>
				</div>
				
			</v-client-table>
			<div class="VuePagination-2 row col-md-12 ">
				<nav class="text-center">
					<ul class="pagination VuePagination__pagination" style="">
						<li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-prev-chunk" v-if="page != 1">
	                        <a class="page-link" @click="changePage(1)">PRIMERO</a>
	                    </li>
						<li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-prev-chunk disabled">
	                        <a class="page-link">&lt;&lt;</a>
	                    </li>
	                    <li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-prev-page" v-if="page > 1">
	                        <a class="page-link" @click="changePage(page - 1)">&lt;</a>
	                    </li>
	                    <li :class="(page == number)?'VuePagination__pagination-item page-item active':'VuePagination__pagination-item page-item'" v-for="number in pageValues" v-if="number <= lastPage">
	                        <a class="page-link active" role="button" @click="changePage(number)">{{number}}</a>
	                    </li>
	                    <li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-next-page" v-if="page < lastPage">
	                        <a class="page-link" @click="changePage(page + 1)">&gt;</a>
	                    </li>
	                    <li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-next-chunk disabled">
	                        <a class="page-link">&gt;&gt;</a>
	                    </li>
	                    <li class="VuePagination__pagination-item page-item  VuePagination__pagination-item-prev-chunk" v-if="lastPage != page">
	                        <a class="page-link" @click="changePage(lastPage)">ÚLTIMO</a>
	                    </li>
					</ul>
					<p class="VuePagination__count text-center col-md-12" style=""> </p>
				</nav>
			</div>
		</div>
		<div class="card-footer text-right">
        	<button type="button" @click="reset()"
					class="btn btn-default btn-icon btn-round"
					title ="Borrar datos del formulario">
					<i class="fa fa-eraser"></i>
			</button>

        	<button type="button"
        			class="btn btn-warning btn-icon btn-round btn-modal-close"
        			data-dismiss="modal"
        			title="Cancelar y regresar">
        			<i class="fa fa-ban"></i>
        	</button>

        	<button type="button"  @click="createForm('asset/requests')"
        			class="btn btn-success btn-icon btn-round btn-modal-save"
        			title="Guardar registro">
        		<i class="fa fa-save"></i>
            </button>
        </div>
	</div>
</template>

<style>
	.selected-row {
		background-color: #d1d1d1 !important;
	}
</style>

<script>
	export default {
		data() {
			return {
				record: {
					id: '',
					date: '',
					motive:'',
					type_id: '',
					delivery_date: '',
					agent_name: '',
					agent_telf: '',
					agent_email: '',

					country_id: '',
					estate_id: '',
					municipality_id: '',
					parish_id: '',
					address: '',

				},
				records: [],
				page: 1,
				total: '',
				perPage: 10,
				lastPage: '',
				pageValues: [1,2,3,4,5,6,7,8,9,10],
				perPageValues: [
					{
						'id': 10,
						'text': '10'
					},
					{
						'id': 25,
						'text': '25'
					},
					{
						'id': 50,
						'text': '50'
					}
				],
				columns: ['check', 'inventory_serial', 'condition', 'status', 'serial', 'marca', 'model'],
				errors: [],

				types: [{"id":"","text":"Seleccione..."},
						{"id":1,"text":"Prestamo de Equipos (Uso Interno)"},
						{"id":2,"text":"Prestamo de Equipos (Uso Externo)"},
						{"id":3,"text":"Prestamo de Equipos para Agentes Externos"}],
				
				selected: [],
				selectAll: false,

				countries: [],
				estates: [],
				municipalities: [],
				parishes: [],

				table_options: {
					rowClassCallback(row) {
						var checkbox = document.getElementById('checkbox_' + row.id);
						return ((checkbox)&&(checkbox.checked))? 'selected-row cursor-pointer' : 'cursor-pointer';
					},
					headings: {
						'inventory_serial': 'Código',
						'condition': 'Condición Física',
						'status': 'Estatus de Uso',
						'serial': 'Serial',
						'marca': 'Marca',
						'model': 'Modelo',
					},
					sortable: ['inventory_serial', 'condition', 'status', 'serial', 'marca', 'model'],
					filterable: ['inventory_serial', 'condition', 'status', 'serial', 'marca', 'model'],
				}
			}
		},
		watch: {
            perPage(res) {
            	if (this.page == 1){
            		this.loadAssets('/asset/registers/vue-list/' + res + '/' + this.page);
            	} else {
            		this.changePage(1);
            	}
            },
            page(res) {
                this.loadAssets('/asset/registers/vue-list/' + this.perPage + '/' + res);
            },
        },
		created() {
			this.loadAssets('/asset/registers/vue-list/' + this.perPage + '/' + this.page);
			this.getCountries();
		},
		mounted() {
			if(this.requestid){
				this.loadForm(this.requestid);
			}
		},
		props: {
			requestid: Number, 
		},
		methods: {
			toggleActive({ row }) {
				const vm = this;
				var checkbox = document.getElementById('checkbox_' + row.id);

				if((checkbox)&&(checkbox.checked == false)){
					var index = vm.selected.indexOf(row.id);
					if (index >= 0){
						vm.selected.splice(index,1);
					}
					else
						checkbox.click();
				}
				else if ((checkbox)&&(checkbox.checked == true)) {
					var index = vm.selected.indexOf(row.id);
					if (index >= 0)
						checkbox.click();
					else
						vm.selected.push(row.id);
				}
		    },

			reset() {
				this.record = {
					id: '',
					created_at: '',
					motive:'',
					type_id: '',
					delivery_date: '',
					agent_name: '',
					agent_telf: '',
					agent_email: '',

					country_id: '',
					estate_id: '',
					municipality_id: '',
					parish_id: '',
					address: '',
				};

				this.selected = [];
				this.selectAll = false;
				
			},
			select() {
				const vm = this;
				vm.selected = [];
				$.each(vm.records, function(index,campo){
					var checkbox = document.getElementById('checkbox_' + campo.id);
					
					if(!vm.selectAll)
						vm.selected.push(campo.id);
					else if(checkbox && checkbox.checked){
						checkbox.click();
					}
				});
			},
			/**
			 * Cambia la pagina actual de la tabla
			 *
			 * @author Henry Paredes <hparedes@cenditel.gob.ve>
			 * 
			 * @param [Integer] $page Número de pagina actual
			 */
			changePage(page) {
                const vm = this;
                vm.page = page;
                var pag = 0;
                while(1) {
                    if (pag + 10 >= vm.page) {
                        pag += 1;
                        break;
                    } else {
                        pag += 10;
                    }
                }
                vm.pageValues = [];
                for (var i = 0; i < 10; i++) {
                    vm.pageValues.push(pag + i);
                }
            },
			createForm(url) {
				const vm = this
				vm.errors = [];
				if(!vm.selected.length > 0){
                	bootbox.alert("Debe agregar almenos un elemento a la solicitud");
					return false;
				};
				vm.record.assets = vm.selected;
				vm.createRecord(url);
			},
		    loadForm(id){
				const vm = this;
	            var fields = {};
	            
	            axios.get('/asset/requests/vue-info/'+id).then(response => {
	                if(typeof(response.data.records != "undefined")){
						vm.record = response.data.records;
						vm.record.created_at = vm.format_date(vm.record.created_at);
	                    fields = response.data.records.asset_request_assets;
	                    $.each(fields, function(index,campo){
	                        vm.selected.push(campo.asset.id);
	                    });
	                }
	            });
			},
			loadAssets(url) {
				const vm = this;
				url += (vm.requestid != null)?'/requests/' + vm.requestid:'/requests';
				axios.get(url).then(response => {
					if (typeof(response.data.records) !== "undefined") {
	                    vm.records  = response.data.records;
						vm.total    = response.data.total;
						vm.lastPage = response.data.lastPage;
						vm.$refs.tableMax.setLimit(vm.perPage);
	                }
				});
			},
		}
	};
</script>
