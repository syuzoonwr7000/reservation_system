@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('予約済み一覧') }}</h1>
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
                                    <th class="px-4 py-2">{{ __('お名前') }}</th>
                                    <th class="px-4 py-2">{{ __('メールアドレス') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td class="border px-4 py-2">{{ $reservation->start_time }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->parent_user->name }}</td>
                                    <td class="border px-4 py-2">{{ $reservation->parent_user->email }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center justify-content-center mt-4 mb-4">
                                            <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button class="btn btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('本当にこの予約をキャンセルしますか？') }}')">{{ __('キャンセル') }}</button>
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