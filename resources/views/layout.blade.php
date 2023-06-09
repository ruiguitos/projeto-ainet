<!DOCTYPE html>
<html lang="en">

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
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#"><i
            class="fas fa-bars"></i></button>
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

                    {{-- Adiciona foto de utilizador e verifica se tem foto ou nao. se tiver mete a foto, senão mete uma default --}}
                    @if(Auth::user()->photo_url)
                        <img src="{{ asset('storage/photos/' . Auth::user()->photo_url) }}"
                             class="img-profile rounded-circle" height="45">
                    @else
                        <img src="{{ asset('img/default_img.png') }}" class="img-profile rounded-circle" height="45">
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="/perfil">
                            Perfil
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="/cart">
                            Carrinho
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('password.change.show') }}">Alterar Senha</a></li>
                    <li>
                        <hr class="dropdown-divider"/>
                    </li>
                    <li>
                        <a class="dropdown-item" onclick="event.preventDefault();
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
                    @if(auth()->check() && auth()->user()->user_type === 'C')
                        <div class="sb-sidenav-menu-heading">Espaço de Compras</div>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.index' ? 'active' : '' }}"
                           href="{{ route('catalogo.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Catálogo
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.camisola' ? 'active' : '' }}"
                           href="{{ route('catalogo.estampa') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                            Camisolas
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.estampa' ? 'active' : '' }}"
                           href="{{ route('catalogo.estampa') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                            Upload de Estampa Personalizada
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'cart.index' ? 'active' : '' }}"
                           href="{{ route('cart.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Carrinho
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'encomendas.clientes' ? 'active' : '' }}"
                           href="{{ route('encomendas.clientes') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Encomendas Cliente
                        </a>

                    @else

                        <div class="sb-sidenav-menu-heading">Espaço de Compras</div>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.index' ? 'active' : '' }}"
                           href="{{ route('catalogo.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Catálogo
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.camisola' ? 'active' : '' }}"
                           href="{{ route('catalogo.camisola') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                            Camisolas
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'catalogo.estampa' ? 'active' : '' }}"
                           href="{{ route('catalogo.estampa') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                            Upload de Estampa Personalizada
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'cart.index' ? 'active' : '' }}"
                           href="{{ route('cart.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Carrinho
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'encomendas.clientes' ? 'active' : '' }}"
                           href="{{ route('encomendas.clientes') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Encomendas Cliente
                        </a>

                        <div class="sb-sidenav-menu-heading">Administração</div>
                        <a class="nav-link" href="/dashboard">
                            <div class="sb-nav-link-icon"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
                            Dashboard
                        </a>
                    @endif

                        <div class="sb-sidenav-menu-heading">Contactos</div>
                        <a class="nav-link" href="/about-us">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                            Contactos
                        </a>
                </div>
            </div>

            @if(auth()->check())
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    @php
                        $fullName = Auth::user()->name;
                        $nameParts = explode(' ', $fullName);
                        $firstName = $nameParts[0];
                        $lastName = count($nameParts) > 1 ? $nameParts[count($nameParts) - 1] : '';
                    @endphp
                    {{ $firstName }} {{ $lastName }}
                </div>
            @endif
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                @if (session('alert-msg'))
                    @include('shared.messages')
                @endif
                @if ($errors->any())
                    @include('shared.alertValidation')
                @endif
                <h1 class="mt-4">@yield('titulo', 'ImagineShirt')</h1>
                @yield('subtitulo')
                <div class="mt-4">
                    @yield('main')
                </div>
            </div>
        </main>
        <footer class="py-2 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy;ImagineShirt 2023</div>
                </div>
            </div>
        </footer>
    </div>
</div>
@vite('resources/js/app.js')
</body>

</html>
