@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('User List') }}</h1>
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
                            <a href="{{ route('users.create') }}" class="btn btn-outline-info">{{ __('User Registration') }}</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">{{ __('User Name') }}</th>
                                    <th class="px-4 py-2">{{ __('Email') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="border px-4 py-2"><a href="{{ route('users.show', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $user->name }}</a></td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center justify-end mt-4 mb-4">
                                            <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-outline-primary  font-bold py-2 px-4 rounded ml-4">{{ __('Information') }}</button></a>
                                            <a href="{{ route('users.edit', $user->id) }}"><button class="btn btn-outline-success font-bold py-2 px-4 rounded ml-4">{{ __('Update') }}</button></a>
                                            <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('Are you sure you want to delete this user?') }}')">{{ __('Delete') }}</button>
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