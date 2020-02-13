@extends('asset::layouts.master')

@section('maproute-icon')
	<i class="ion-ios-pricetags-outline"></i>
@stop

@section('maproute-icon-mini')
	<i class="ion-ios-pricetags-outline"></i>
@stop

@section('maproute-actual')
	Bienes
@stop

@section('maproute-title')
	Gestión de Bienes Institucionales
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<asset-request-create
				route_list="{{ url('asset/requests')}}"
				:requestid ="{!! (isset($request)) ? $request->id : 'null' !!}">
			</asset-request-create>
		</div>

	</div>

@stop
