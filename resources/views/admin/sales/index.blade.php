@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('売上一覧') }}</h1>
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
                                    <th class="px-4 py-2">{{ __('売上日') }}</th>
                                    <th class="px-4 py-2">{{ __('売上金額') }}</th>
                                    <th class="px-4 py-2">{{ __('施術件数') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_sales as $sales)
                                <tr>
                                    <td class="border px-4 py-2">{{ $sales->sales_date }}</td>
                                    <td class="border px-4 py-2">￥{{ number_format(5000 * count($sales->children_reservations), 0, '.', ',') }}</td>
                                    <td class="border px-4 py-2">{{ count($sales->children_reservations) }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center justify-content-center mt-4 mb-4">
                                            <a href="{{ route('admin.sales.show', $sales->id) }}"><button class="btn btn-outline-primary font-bold py-2 px-4 rounded ml-4">{{ __('詳細') }}</button></a>
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