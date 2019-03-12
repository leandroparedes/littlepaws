<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="mx-auto order-0">
        <a class="navbar-brand" href={{ route('producto.index') }}>
            <img src={{URL::to('logo.jpeg')}} alt="Little Paws" class="logo">
        </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href={{ route('producto.index') }}>Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('producto.promociones') }}>Promociones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('sugerencias.index') }}>Sugerencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('foro.index') }}>Foro</a>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producto.carrito') }}">
                <i class="fas fa-shopping-cart"></i> Carrito de compras <span class="badge badge-pill badge-primary">{{ Session::has('carrito') ? Session::get('carrito')->cantidadTotal : '' }}</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @guest
                        <a class="dropdown-item" href="{{ route('user.signup') }}">Registrate</a>
                        <a class="dropdown-item" href="{{ route('user.signin') }}">Iniciar sesión</a>
                    @endguest
                    @auth
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Mi cuenta</a>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">Cerrar sesión</a>   
                    @endauth
                </div>
            </li>
        </ul>
    </div>
</nav>