<!DOCTYPE html>
<html lang="es">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="{{ asset('CSS/plantilla.css') }}">
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
    <script src="/JS/main.js"></script>
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="IMG/Aguile.png" class="rounded-image" style="max-width: 100px;">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <!-- Aquí puedes agregar otros elementos de la navegación a la izquierda -->
            </div>

            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                      
                    </a>
                    <div class="navbar-dropdown">
                        
                        <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>&nbsp; Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- <h1 class="title is-3">Sistema de Informacion Integral</h1> --}}
    <div class="container is-fluid">
        @yield('content')
    </div>
</body>

</html>
