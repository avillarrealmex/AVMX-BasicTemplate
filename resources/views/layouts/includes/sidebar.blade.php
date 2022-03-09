<div class="sidebar-menu">
    <ul class="list-unstyled ps-0 components nav">
        <li class="sidebar-header" data-bs-toggle="collapse" data-bs-target="#gestion-collapse" aria-expanded="false">
            <i class="fa-solid fa-list-check"></i> Catálogos
        </li>
        <div class="collapse" id="gestion-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li class="sidebar-submenu">
                    <a href="{{route('user.table')}}" class="link-dark rounded">
                        <i class="fa-solid fa-user-group"></i> Usuarios
                    </a>
                </li>
                <li class="sidebar-submenu">
                    <a href="{{route('provider.table')}}" class="link-dark rounded">
                        <i class="fa-solid fa-user-tag"></i> Proveedores
                    </a>
                </li>
                <li class="sidebar-submenu">
                    <a href="{{route('customer.table')}}" class="link-dark rounded">
                        <i class="fa-solid fa-earth-americas"></i> Clientes
                    </a>
                </li>
                <li class="sidebar-submenu">
                    <a href="{{route('product.table')}}" class="link-dark rounded">
                        <i class="fa-brands fa-wpforms"></i> Productos
                    </a>
                </li>
            </ul>
        </div>
        <li class="sidebar-header" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
            <i class="fas fa-cog"></i> {{ Auth::user()->name }}
        </li>
        <div class="collapse" id="account-collapse" style="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li class="sidebar-submenu">
                    <a class="link-dark rounded" href="{{route('logout')}}">
                        <i class="fas fa-power-off"></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </ul>
</div>
