<a class="navbar-brand col-sm-1 col-md-1 mr-0" href="{{ route('login.dashboard') }}">
    <img src="{{ asset('images/logotipo nikken-03.png') }}" class="img-center logoNikken" alt="logoNikken" height="96"/>
</a>
<div class="btnSidebar">
    <button id="showHideSidebar">☰</button>
</div>
<nav class="navbar navbar-expand float-right" id="nav" style="padding-right: 2vw;">
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown" style="text-transform: initial;">
                <a class="nav-link dropdown-toggle" href="#" id="languague" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-gear"></i>
                    {{ Session::get('nombre') ? Session::get('nombre') : 'Usuario' }}
                </a>
                <div class="dropdown-menu" aria-labelledby="languague">
                    <a class="dropdown-item" href="{{ route('login.dashboard') }}" id="startGuide"><i class="fa-solid fa-route"></i> Iniciar recorrido</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
