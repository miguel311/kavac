@extends('payroll::layouts.master')

@section('maproute-icon')
	<i class="ion-settings"></i>
@stop

@section('maproute-icon-mini')
	<i class="ion-settings"></i>
@stop

@section('maproute-actual')
	Nómina
@stop

@section('maproute-title')
	Nacionalidades
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Nacionalidades</h6>
					<div class="card-btns">
						@include('buttons.previous', ['route' => url()->previous()])
						@include('buttons.new', ['route' => route('payroll.nationalities.create')])
						@include('buttons.minimize')
					</div>
				</div>
				<div class="card-body">
					<table class="table table-big table-hover table-striped dt-responsive nowrap datatable">
						<thead>
							<tr class="text-center">
								<th>Nacionalidad</th>
								<th>País</th>
								<th width="10%">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($nationalities as $nationality)
								<tr class="text-center">
									<td> {{ $nationality->name }} </td>
									<td> {{ $nationality->country->name }} </td>
									<td>
										<div class="d-inline-flex">
											<a href="{{ route('payroll.nationalities.edit', $nationality) }}" class="btn btn-warning btn-xs btn-icon btn-action" data-toggle="tooltip" title="Actualizar"><i class="fa fa-edit"></i></a>
											<button class="btn btn-danger btn-xs btn-icon btn-action" onclick="delete_record('{{ route('payroll.nationalities.destroy', $nationality) }}')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o"></i></button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
