@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $sales->sales_date }}</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ __(session('error')) }}</div>
@endif
@foreach($sales->children_reservations as $reservation)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $reservation->start_time }}</h5>
            <p class="card-text">{{ $reservation->parent_user->name }} 様</p>
        </div>
    </div>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop