@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('登録情報')}}</h1>
@stop

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <th class="px-4 py-2 text-gray-500">{{ __('ユーザー名') }}</th>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('Email') }}</th>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4 mb-4 mr-4 text-right">
                        <a href="{{ route('auth.edit') }}"><button class="btn btn-outline-success font-bold py-2 px-4 rounded ml-4">{{ __('プロフィール編集') }}</button></a>
                        @if(auth()->user()->role == 3)
                        <form action="{{ route('auth.delete') }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('本当に退会しますか？') }}')">{{ __('退会') }}</button>
                        @endif
                        </form>
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
