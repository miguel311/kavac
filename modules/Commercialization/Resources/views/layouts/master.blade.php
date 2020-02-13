@extends('layouts.app')

@section('modules-js')
    @parent
    {!! Html::script(mix('modules/commercialization/js/app.js'), [], Request::secure()) !!}
@endsection

@section('modules-css')
    @parent
    {!! Html::style(mix('modules/commercialization/css/app.css'), [], Request::secure()) !!}
@endsection
