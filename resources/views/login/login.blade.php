@extends('layouts.login')
@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card fondo-logo-sombra">
                    <div class="logoNikken">
                        <img src="{{ asset('images/logo_nikken.png')}}" class="img-fluid" alt="Responsive image"/>
                    </div>
                    <div class="card-body">
                            <br/>
                            @php if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
                            {
                            $login_email = $_COOKIE['login_email'];
                            $login_pass  = $_COOKIE['login_pass'];
                            $is_remember = "checked='checked'";
                            }
                            else{
                            $login_email ='';
                            $login_pass = '';
                            $is_remember = "";
                            }
                            @endphp
                        <form role="form" action="{{route('post.login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="useremail">Código de usuario <span class="text-danger">*</span></label>
                                <input type="text" name="email" value="{{$login_email}}"  class="form-control">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="userpassword">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" name="password" value="{{$login_pass}}" class="form-control">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="checkbox pull-right">
                                <label>
                                <input type="checkbox" name="rememberme" {{$is_remember}}>
                                Recordar contraseña </label>
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
