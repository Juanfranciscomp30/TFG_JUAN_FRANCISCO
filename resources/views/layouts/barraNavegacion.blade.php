<link rel="stylesheet" href="{{ asset('css/barraNavegacion.css') }}">

<nav class="navbar navbar-expand-lg custom-navbar px-4 py-2 mb-4">
    <a class="navbar-brand d-flex align-items-center" href="/instrumentos">
        <img src="https://via.placeholder.com/50" alt="Logo" height="40" class="mr-2" style="border: 2px solid #468189;">
        <span class="ml-2 font-weight-bold logo-title" style="letter-spacing:1px;">MUSIC STORE</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/instrumentos"><i class="fa-solid fa-music"></i> Instrumentos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('carrito.ver') }}" class="btn btn-cart">
                        <i class="fa-solid fa-cart-shopping"></i> Ver Carrito
                    </a>
                </li>
                @if(auth()->user()->administrador)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gears"></i> Panel Admin</a>
                    </li>
                @endif
                <li class="nav-item">
                    <form action="/logout" method="POST" class="d-inline">
                        @csrf
                        <button class="nav-link btn btn-link logout-btn" type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login"><i class="fa-solid fa-user"></i> Iniciar sesión</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
