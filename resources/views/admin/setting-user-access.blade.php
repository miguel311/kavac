@extends('layouts.app')

@section('maproute-icon')
	<i class="ion-settings"></i>
@stop

@section('maproute-icon-mini')
	<i class="ion-settings"></i>
@stop

@section('maproute-actual')
	{{ __('Usuario') }}
@stop

@section('maproute-title')
	{{ __('Permisos de Acceso') }}
@stop

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">{{ __('Usuario (:user)', ['user' => $user->name]) }} - {{ __('Roles y Permisos') }}</h6>
					<div class="card-btns">
						@include('buttons.previous', ['route' => url()->previous()])
						@include('buttons.minimize')
					</div>
				</div>
				{!! Form::open(['route' => 'roles.permissions.assign', 'method' => 'POST']) !!}
					{!! Form::token() !!}
					{!! Form::hidden('user', $user->id) !!}
					<div class="card-body">
						@include('layouts.form-errors')
						@include('auth.roles-permissions', ['user' => $user])
					</div>
					<div class="card-footer text-right">
						@include('buttons.form-display')
						@include('layouts.form-buttons')
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop
