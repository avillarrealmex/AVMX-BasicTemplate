<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('login.dashboard') }}">
    <img src="{{ asset('images/logo_nikken.png') }}" class="img-center logoNikken" alt="Responsive image"/>
</a>
<nav class="navbar navbar-expand-lg navbar-dark" id="navBarOptions">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languague" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i>
                    {{ Session::get('nombre') ? Session::get('nombre') : 'Usuario' }}
                </a>
                <div class="dropdown-menu" aria-labelledby="languague">
                    {{-- <a class="dropdown-item" href="#" id="changePassword"><i class="fa-solid fa-key"></i> Cambiar contraseña</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
