<template>
	<div class="col-xs-2 text-center">
		<a class="btn-simplex btn-simplex-md btn-simplex-primary"
		   href="" title="Registros de tipos de instituciones"
		   data-toggle="tooltip" @click="addRecord('add_institution_type', 'institution-types', $event)">
			<i class="icofont icofont-building-alt ico-3x"></i>
			<span>Tipo<br>Instituciones</span>
		</a>
		<div class="modal fade text-left" tabindex="-1" role="dialog" id="add_institution_type">
			<div class="modal-dialog vue-crud" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h6>
							<i class="icofont icofont-building-alt inline-block"></i>
							Tipo de Institución
						</h6>
					</div>
					<div class="modal-body">
						<div class="alert alert-danger" v-if="errors.length > 0">
							<ul>
								<li v-for="error in errors">{{ error }}</li>
							</ul>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Acrónimo:</label>
									<input type="text" placeholder="Acrónimo" data-toggle="tooltip"
										   title="Indique el acrónimo del tipo de institución"
										   class="form-control input-sm" v-model="record.acronym">
									<input type="hidden" v-model="record.id">
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group is-required">
									<label>Nombre:</label>
									<input type="text" placeholder="Tipo" class="form-control input-sm" data-toggle="tooltip"
										   v-model="record.name" title="Indique el nombre del tipo de institución (requerido)">
			                    </div>
							</div>
						</div>
	                </div>
	                <div class="modal-footer">
	                	<div class="form-group">
	                		<modal-form-buttons :saveRoute="'institution-types'"></modal-form-buttons>
	                	</div>
	                </div>
	                <div class="modal-body modal-table">
	                	<v-client-table :columns="columns" :data="records" :options="table_options">
	                		<div slot="id" slot-scope="props" class="text-center">
	                			<button @click="initUpdate(props.index, $event)"
		                				class="btn btn-warning btn-xs btn-icon btn-action"
		                				title="Modificar registro" data-toggle="tooltip" type="button">
		                			<i class="fa fa-edit"></i>
		                		</button>
		                		<button @click="deleteRecord(props.index, 'institution-types')"
										class="btn btn-danger btn-xs btn-icon btn-action"
										title="Eliminar registro" data-toggle="tooltip"
										type="button">
									<i class="fa fa-trash-o"></i>
								</button>
	                		</div>
	                	</v-client-table>
	                </div>
		        </div>
		    </div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				record: {
					id: '',
					acronym: '',
					name: ''
				},
				errors: [],
				records: [],
				columns: ['acronym', 'name', 'id'],
			}
		},
		methods: {
			/**
			 * Método que borra todos los datos del formulario
			 *
			 * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
			 */
			reset() {
				this.record = {
					id: '',
					acronym: '',
					name: ''
				};
			},
		},
		created() {
			this.table_options.headings = {
				'acronym': 'Acrónimo',
				'name': 'Nombre',
				'id': 'Acción'
			};
			this.table_options.sortable = ['name', 'acronym'];
			this.table_options.filterable = ['name', 'acronym'];
			this.table_options.columnsClasses = {
				'acronym': 'col-md-2',
				'name': 'col-md-8',
				'id': 'col-md-2'
			};
		},
	};
</script>
