<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>ImagineShirt</title>
    @vite('resources/sass/app.scss')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand " href="{{ route('home') }}">
        <img src="/img/plain_white.png" alt="Logo" class="bg-dark" width="50" height="50">
        ImagineShirt
    </a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#">
        <i
            class="fas fa-bars">
        </i>
    </button>
    @guest
        <ul class="navbar-nav ms-auto me-1 me-lg-3">
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </li>
            @endif
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </li>
            @endif
        </ul>
    @else
        <div class="ms-auto me-0 me-md-2 my-2 my-md-0 navbar-text">
            {{ Auth::user()->name }}
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav me-1 me-lg-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                        src="{{Auth::user()->photo_url ? asset('storage/photos/' . Auth::user()->photo_url) : asset('img/default_img.png') }}"
                        alt="Imagem do Cliente" class="img-profile rounded-circle" height="45">

                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                    <li><a class="dropdown-item" href="/password/reset">Alterar Senha</a></li>
                    <li>
                        <hr class="dropdown-divider"/>
                    </li>
                    <li>
                        <a class="dropdown-item"
                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    @endguest
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Espaço de Compras</div>
                        <a class="nav-link" href="/catalogo">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Catálogo de T-Shirts
                        </a>

                        <a class="nav-link" href="/imagens">
                            <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                            Catálogo de Imagens
                        </a>

                    <div class="sb-sidenav-menu-heading">Espaço Admin</div>
                        <a class="nav-link" href="/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Admin Dashboard
                        </a>
                        <a class="nav-link" href="/clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="/encomendas">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Encomendas
                        </a>

                </div>
            </div>
{{--            <div class="sb-sidenav-footer">--}}
{{--                <div class="small">Logged in as: </div>--}}
{{--                {{ Auth::user()->name }}--}}
{{--            </div>--}}
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <br>
                @yield('subtitulo')
                <div class="mt-4">
                    @yield('main')
                </div>
            </div>
        </main>
        <footer class="py-2 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy;ImagineShirt</div>
                </div>
            </div>
        </footer>
    </div>
</div>
@vite('resources/js/app.js')
</body>

</html>
