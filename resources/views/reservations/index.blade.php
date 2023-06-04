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
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('reservations.create') }}" class="btn btn-outline-info">{{ __('予約枠追加') }}</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('予約日') }}</th>
                                    <th class="px-4 py-2">{{ __('件数') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td class="border px-4 py-2">{{ $reservation->start_time }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->id }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center justify-end mt-4 mb-4">
                                            <a href="{{ route('reservations.show', $reservation->id) }}"><button class="btn btn-outline-primary  font-bold py-2 px-4 rounded ml-4">{{ __('Information') }}</button></a>
                                            <a href="{{ route('reservations.edit', $reservation->id) }}"><button class="btn btn-outline-success font-bold py-2 px-4 rounded ml-4">{{ __('編集') }}</button></a>
                                            <form action="{{ route('reservations.delete', $reservation->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('本当にこの予約枠を削除しますか？') }}')">{{ __('削除') }}</button>
                                            </form>
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