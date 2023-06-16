@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>{{ __('登録情報変更') }}</h2>
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
                    @if(auth()->user()->role == 3)
                    <form method="POST" action="{{ route('user.update') }}">
                    @elseif(auth()->user()->role == 2)
                    <form method="POST" action="{{ route('admin.update') }}">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('User Name') }}</label>
                            <input id="name" class="form-control" type="text" name="name" value="{{ old('name',$user->name) }}" required autofocus />
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email',$user->email) }}" required />
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                        <div class="input-group">
                            <input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" autocomplete="new-password" />
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(function() {
                            $("#toggle-password").click(function() {
                                var input = $("#password");
                                var icon = $(this).find("i");
                                if (input.attr("type") === "password") {
                                    input.attr("type", "text");
                                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                                } else {
                                    input.attr("type", "password");
                                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                                }
                            });
                            $("#toggle-password-confirm").click(function() {
                                var input = $("#password_confirmation");
                                var icon = $(this).find("i");
                                if (input.attr("type") === "password") {
                                    input.attr("type", "text");
                                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                                } else {
                                    input.attr("type", "password");
                                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                                }
                            });
                        });
                    </script>
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('New Password Confirmation') }}</label>
                        <div class="input-group">
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password" />
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        
                    </script>
                        <div class="form-group" >
                            <button type="submit" class="btn btn-outline-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
</script>
@stop