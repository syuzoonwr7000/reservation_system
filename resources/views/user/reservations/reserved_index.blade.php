@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('予約一覧') }}</h1>
@stop

@section('content')
@if(session('error'))
<div class="alert alert-danger">{{ __(session('error')) }}</div>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('予約日時') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reserved_reservations as $reserved_reservation)
                                <tr>
                                    <td class="border px-4 py-2">{{ $reserved_reservation->start_time }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center justify-end mt-4 mb-4">
                                            <a href="{{ route('user.reservations.show', $reserved_reservation->id) }}"><button class="btn btn-outline-primary  font-bold py-2 px-4 rounded ml-4">{{ __('確認、キャンセル') }}</button></a>
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
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop