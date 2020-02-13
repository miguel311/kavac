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
		<asset-disincorporation-create
			route_list="{{ url('asset/disincorporations')}}"
			:disincorporationid ="{!! (isset($disincorporation)) ? $disincorporation->id : 'null' !!}"
			:assetid ="{!! (isset($asset)) ? $asset->id : 'null' !!}">
		</asset-disincorporation-create>
	</div>

</div>
@stop

