@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('予約確認')}}</h1>
@stop

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <th class="px-4 py-2 text-gray-500">{{ __('お名前') }}</th>
                                <td class="px-4 py-2">{{ $user->name }} 様</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('Email') }}</th>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('予約日時') }}</th>
                                <td class="px-4 py-2">{{ $reserved_reservation->start_time }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4 mb-4 mr-4 text-right">
                        <form action="{{ route('user.reservations.cancel', $reserved_reservation->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('この予約をキャンセルします、よろしいでしょうか？') }}')">{{ __('キャンセル') }}</button>
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
