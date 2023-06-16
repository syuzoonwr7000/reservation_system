@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>{{ __('予約枠追加') }}</h2>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.reservations.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="date">{{ __('日付') }}</label>
                            <input id="date" class="form-control" type="date" name="date" value="{{ old('date') }}" required autofocus />
                        </div>
                        <div class="form-group">
                            <label for="time">{{ __('時間枠') }}</label>
                            <select id="time" class="form-control" name="time" required>
                                <option value="10:00">10:00</option>
                                <option value="13:00">13:00</option>
                                <option value="15:00">15:00</option>
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-outline-primary">{{ __('Regist') }}</button>
                        </div>
                    </form>
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
