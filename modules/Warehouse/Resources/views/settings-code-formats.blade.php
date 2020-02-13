<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Formatos de Códigos</h6>
					<div class="card-btns">
						@include('buttons.previous', ['route' => url()->previous()])
						@include('buttons.minimize')
					</div>
				</div>
				{!! Form::open(['route' => 'warehouse.setting.store', 'method' => 'post']) !!}
					{!! Form::token() !!}
					<div class="card-body">
						@include('layouts.form-errors')
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									{!! Form::label('product_code', 'Código de los productos en inventario', []) !!}
									{!! Form::text('products_code', ($pdCode) ? $pdCode->format_code : old('products_code'), [
										'class' => 'form-control', 'data-toggle' => 'tooltip',
										'title' => 'Formato para el código de los productos en inventario',
										'placeholder' => 'Ej. XXX-00000000-YYYY',
										'readonly' => ($pdCode) ? true : false
									]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{!! Form::label('movement_code', 'Código de los movimientos de almacén', []) !!}
									{!! Form::text('movements_code', ($mvCode) ? $mvCode->format_code : old('movements_code'), [
										'class' => 'form-control', 'data-toggle' => 'tooltip',
										'title' => 'Formato para el código de los movimientos de almacén',
										'placeholder' => 'Ej. XXX-00000000-YYYY',
										'readonly' => ($mvCode) ? true : false
									]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{!! Form::label('request_code', 'Código de las solicitudes de almacén', []) !!}
									{!! Form::text('requests_code', ($rqCode) ? $rqCode->format_code : old('requests_code'), [
										'class' => 'form-control', 'data-toggle' => 'tooltip',
										'title' => 'Formato para el código de las solicitudes',
										'placeholder' => 'Ej. XXX-00000000-YYYY',
										'readonly' => ($rqCode) ? true : false
									]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{!! Form::label('report_code', 'Código de los reportes', []) !!}
									{!! Form::text('reports_code', ($rpCode) ? $rpCode->format_code : old('reports_code'), [
										'class' => 'form-control', 'data-toggle' => 'tooltip',
										'title' => 'Formato para el código de los reportes de inventario',
										'placeholder' => 'Ej. XXX-00000000-YYYY',
										'readonly' => ($rpCode) ? true : false
									]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									{!! Form::label('inventory_code', 'Código de inventario', []) !!}
									{!! Form::text('inventories_code', ($ivCode) ? $ivCode->format_code : old('inventories_code'), [
										'class' => 'form-control', 'data-toggle' => 'tooltip',
										'title' => 'Formato para el código de las capturas de los estados de inventario del almacén',
										'placeholder' => 'Ej. XXX-00000000-YYYY',
										'readonly' => ($ivCode) ? true : false
									]) !!}
								</div>
							</div>
						</div>
						@include('layouts.help-text', ['codeSetting' => true])
					</div>
					<div class="card-footer text-right">
						@include('layouts.form-buttons')
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>