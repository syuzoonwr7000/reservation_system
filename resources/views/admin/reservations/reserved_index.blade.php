@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('予約済み一覧') }}</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ __(session('error')) }}</div>
@endif
@foreach($reservations_by_dates as $date => $reservations)
    <div class="card">
        <div class="card-body" data-toggle="collapse" data-target="#reservations-{{ $date }}" aria-expanded="false" aria-controls="reservations-{{ $date }}">
            <h5 class="card-title">{{ $date }}</h5>
            <p class="card-text">{{ $reservations->count() }} 件</p>
        </div>
        <div id="reservations-{{ $date }}" class="collapse">
            <ul class="list-group">
                @foreach($reservations as $reservation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $reservation->start_time->format('G:i') }} {{ $reservation->parent_user->name }}様
                        </div>
                        <div class="flex items-center justify-content-center">
                            <form action="{{ route('admin.reservations.add_reservation_to_sales', $reservation->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @if(\Carbon\Carbon::parse($reservation->start_time)->isPast())
                                    <button class="btn btn-outline-primary font-bold py-2 px-4 rounded ml-4" type="submit">{{ __('施術済み') }}</button>
                                @endif
                            </form>
                            <form action="{{ route('admin.reservations.cancel', $reservation->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-4" type="submit" onclick="return confirm('{{ __('本当にこの予約をキャンセルしますか？') }}')">{{ __('キャンセル') }}</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
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
