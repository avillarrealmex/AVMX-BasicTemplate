<ul class="list-unstyled ps-0 components nav">
    <li class="mb-1" data-bs-toggle="collapse" data-bs-target="#gestion-collapse" aria-expanded="false">
        <i class="fa-solid fa-list-check"></i> Gestión
    </li>
    <div class="collapse" id="gestion-collapse">
        <ul>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-solid fa-user-group"></i> Usuarios
                </a>
            </li>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-solid fa-user-tag"></i> Beneficiados
                </a>
            </li>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-solid fa-earth-americas"></i> Paises
                </a>
            </li>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-brands fa-wpforms"></i> Concepto especifico
                </a>
            </li>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-solid fa-database"></i> Centro de costos
                </a>
            </li>
            <li>
                <a href="#" class="link-dark rounded">
                    <i class="fa-brands fa-wpforms"></i> Proyectos
                </a>
            </li>
        </ul>
    </div>

    <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#presupuesto-collapse" aria-expanded="false">
            <i class="fa-solid fa-calculator"></i> Presupuesto
        </button>
        <div class="collapse" id="presupuesto-collapse" style="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="{{route('presupuesto.registro')}}" class="link-dark rounded">
                        <i class="fas fa-calendar-check"></i> Registro
                    </a>
                </li>
                <li>
                    <a href="{{route('presupuesto.autorizacion')}}" class="link-dark rounded">
                        <i class="fas fa-user-plus"></i> Autorización
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#reportes-collapse" aria-expanded="false">
            <i class="fa-solid fa-chart-line"></i> Reportes
        </button>
        <div class="collapse" id="reportes-collapse" style="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a href="#" class="link-dark rounded">
                        <i class="fas fa-chart-area"></i> Presupuesto
                    </a>
                </li>
                <li>
                    <a href="#" class="link-dark rounded">
                        <i class="fas fa-chart-line"></i> Income
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="border-top my-3"></li>
</ul>
<ul class="list-unstyled ps-0 components nav">
    <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
            <i class="fas fa-cog"></i> {{ Auth::user()->name }}
        </button>
        <div class="collapse" id="account-collapse" style="">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-power-off"></i> Cerrar sesión</a></li>
            </ul>
        </div>
    </li>
</ul>
