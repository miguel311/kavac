@extends('commercialization::layouts.master')

@section('maproute-icon')
	<i class="ion-settings"></i>
@stop

@section('maproute-icon-mini')
	<i class="ion-settings"></i>
@stop

@section('maproute-actual')
	Comercialización
@stop

@section('maproute-title')
	Configuración
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">CONFIGURACIÓN GENERAL DE COMERCIALIZACIÓN</h6>
					<div class="card-btns">
						@include('buttons.previous', ['route' => url()->previous()])
						@include('buttons.minimize')
					</div>
					{!! Form::open(['route' => 'commercialization.settings.store', 'method' => 'post']) !!}
						{!! Form::token() !!}
						<div class="card-body">
							@include('layouts.form-errors')

						<div class="row">
							<div class="col-12">
								<h6>config</h6>
							</div>
						</div>
						<div class="row">



							@foreach ($com_senttings as $item)
							
						    <tr>
						      <th {{ $item->iva }}</th>
						      <th>{{ $item->rif_cedule }}</td>
						      <th>{{ $item->name_facturation }}</td>
						      <th>{{ $item->name_facturation }}</td>
						      <th>{{ $item->money_id }}</td>
						      <th>{{ $item->start_billing_number }}</td>
						      <th>{{ $item->end_billing_number }}</td>
						    </tr>


							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									<form method="POST" action="{{ route('commercialization.settings.store') }}">
									  @csrf
									  <input
									    type="text"
									    name="iva"
									    placeholder="Iva"
									    class="form-control mb-2"
									    value="{{ $item->iva }}"
									  />
									  <input
									    type="text"
									    name="Rif o Cédula"
									    placeholder="Rif o Cédula"
									    class="form-control mb-2"
									    value = "{{ $item->rif_cedule }}"
									  />
									</form>
								</div>
							</div>



						    @endforeach


							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									<form method="POST" action="{{ route('commercialization.settings.store') }}">
									  @csrf
									  <input
									    type="text"
									    name="nombre"
									    placeholder="Nombre1"
									    class="form-control mb-2"
									  />
									  <input
									    type="text"
									    name="descripcion"
									    placeholder="Descripcion"
									    class="form-control mb-2"
									  />
									</form>
								</div>
							</div>
							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									<form method="POST" action="{{ route('commercialization.settings.store') }}">
									  @csrf
									  <input
									    type="text"
									    name="nombre"
									    placeholder="Nombre2"
									    class="form-control mb-2"
									  />
									  <input
									    type="text"
									    name="descripcion"
									    placeholder="Descripcion"
									    class="form-control mb-2"
									  />
									</form>
								</div>
							</div>
						</div>












							{{--  @include('layouts.help-text', ['codeSetting' => true]) --}}
						</div>
						<div class="card-footer text-right">
							@include('layouts.form-buttons')
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Lista de Monedas Disponibles para facturar</h6>
					<div class="card-btns">
						@include('buttons.minimize')
					</div>
					{!! Form::open(['route' => 'commercialization.settings.store', 'method' => 'post']) !!}
						{!! Form::token() !!}
						<div class="card-body">
							@include('layouts.form-errors')
							<div class="row">
								<div class="col-12">
									<h6>Monedas</h6>
								</div>
							</div>
							<div class="row">

								<table class="table">
								  <thead>
								    <tr>
								      <th scope="col">Moneda</th>
								      <th scope="col">Simbolo</th>
								      <th scope="col">Valor</th>
								    </tr>
								  </thead>
								  <tbody>
								    @foreach ($com_smoney as $item)
								    <tr>
								      <th scope="row">{{ $item->name_money }}</th>
								      <th>{{ $item->money_type }}</td>
								      <th>{{ $item->exchange_rate }}</td>
								    </tr>
								    @endforeach
								  </tbody>
								</table>

							</div>
							{{--  @include('layouts.help-text', ['codeSetting' => true]) --}}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop




















TEST 




			<?php
							print($com_smoney);
							?>

							@foreach ($com_senttings as $item)
		
							
							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									@csrf
									  <input
									    type="text"
									    name="iva"
									    placeholder="Iva"
									    class="form-control mb-2"
									    value="{{ $item->iva }}"
									  />
									  <input
									    type="text"
									    name="Rif o Cédula"
									    placeholder="Rif o Cédula"
									    class="form-control mb-2"
									    value = "{{ $item->rif_cedule }}"
									  />
								</div>
							</div>



							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									@csrf
									  <input
									    type="text"
									    name="Nombre de razón social"
									    placeholder="Nombre de razón social"
									    class="form-control mb-2"
									    value="{{ $item->name_facturation }}"
									  />
									  <input
									    type="text"
									    name="Meneda a facturar"
									    placeholder="Moneda a facturar"
									    class="form-control mb-2"
									    value = "{{ $item->money_id }}"
									  />
								</div>
							</div>





							<div class="col-md-4" id="helpCodeCommitments">
								<div class="form-group">
									@csrf
									  <input
									    type="text"
									    name="Nombre de razón social"
									    placeholder="Nombre de razón social"
									    class="form-control mb-2"
									    value="{{ $item->start_billing_number }}"
									  />
									  <input
									    type="text"
									    name="Meneda a facturar"
									    placeholder="Moneda a facturar"
									    class="form-control mb-2"
									    value = "{{ $item->end_billing_number }}"
									  />
								</div>
							</div>

						    @endforeach
