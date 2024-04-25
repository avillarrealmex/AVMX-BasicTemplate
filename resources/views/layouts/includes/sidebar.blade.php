<ul class="list-unstyled ps-0 components nav">
    <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="sidebar-header">
        <li>
            <i class="fa-solid fa-chart-bar"></i> Dashboard
        </li>
    </a>
    <a href="#manager" data-toggle="collapse" aria-expanded="false" class="sidebar-header">
        <li>
            <i class="fa-solid fa-shield-halved"></i> Administración de la herramienta
        </li>
    </a>
    <ul class="list-unstyled collapse" id="manager">
        <a href="{{route('users.index')}}" class="sidebar-submenu">
            <li>
                <i class="fa-solid fa-user-shield"></i> Usuarios
            </li>
        </a>
        <a href="{{route('login.dashboard')}}" class="sidebar-submenu">
            <li>
                <i class="fa-solid fa-file-shield"></i> Roles y permisos
            </li>
        </a>
    </ul>
</ul>
