@extends('layouts.main')

@section('content')
<h1> Insertar Usuario </h1>
    <form role="form" action="{{ route('user.create')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Nombre de usuario</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            <span class="alert"> {{$errors->first('name')}} </span>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            <span class="alert"> {{$errors->first('password')}} </span>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="{{old('password_confirm')}}">
            <span class="alert"> {{$errors->first('password_confirm')}} </span>
        </div>
        <div class="form-group">
            <label for="">email</label>
            <input type="type" class="form-control" id="email" name="email" value="{{old('email')}}">
            <span class="alert"> {{$errors->first('email')}} </span>
        </div>
        <div class="form-group">
            <label for="">tipoUsuario</label>
            <input type="text" class="form-control" id="tipoUsuario" name="tipoUsuario" value="{{old('tipoUsuario')}}">
            <span class="alert"> {{$errors->first('tipoUsuario')}} </span>
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>


@endsection
