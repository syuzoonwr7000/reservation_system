@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>{{ __('User Infomation')}}</h2>
@stop

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <th class="px-4 py-2 text-gray-500">{{ __('User Name') }}</th>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('Email') }}</th>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('Created date/time') }}</th>
                                <td class="px-4 py-2">{{ $user->created_at }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-gray-500">{{ __('Updated date/time') }}</th>
                                <td class="px-4 py-2">{{ $user->updated_at }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4 mb-4">
                        <a href="{{ route('users.edit', $user->id) }}"><button class="btn btn-outline-success font-bold py-2 px-4 rounded ml-4">{{ __('Update') }}</button></a>
                        <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger font-bold py-2 px-4 rounded ml-4 " type="submit" onclick="return confirm(' {{ __('Are you sure you want to delete this user?') }}')">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>
@stop