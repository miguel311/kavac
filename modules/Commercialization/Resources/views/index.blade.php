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
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('commercialization.name') !!}
    </p>
@stop
