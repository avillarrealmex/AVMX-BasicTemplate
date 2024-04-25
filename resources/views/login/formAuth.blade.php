@extends('layouts.login')

@section('content')
    <script src="{{ asset('js/login/formAuth.js') }}"></script>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card fondo-logo-sombra">
                    <div class="logoNikken">
                        <img src="{{ asset('images/logo_nikken_green.png')}}" width="150" height="50" class="img-fluid" alt="Responsive image"/>
                    </div>
                    <div class="card-body">
                        {{-- Sección para el remember Me --}}
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-12 text-center">
                                @if ($errors->any())
                                    <div class="alert alert-danger" id="errorSection">
                                        <span class="text-center">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            @if ($errors->has('msg'))
                                                {{ $errors->first('msg') }}
                                            @else
                                                Upss, se encontrarón los siguientes errores
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Sección del formulario --}}
                        <form role="form" action="{{route('post.login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="code">Código de usuario <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control" value="{{ isset($_COOKIE['code']) ? $_COOKIE['code'] : old('code') }}">
                                @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" value="{{ isset($_COOKIE['password']) ? $_COOKIE['password'] : old('password') }}">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" name="rememberme" {{ isset($_COOKIE['code']) ? "checked='checked'" : '' }}>
                                    Recordar contraseña
                                </label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-large btn-secondary">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
