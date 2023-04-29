<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
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
                    <img src="/img/avatar_unknown.png" alt="Avatar" class="bg-dark rounded-circle" width="45"
                         height="45">
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Alterar Senha</a></li>
                    <li>
                        <hr class="dropdown-divider" />
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
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Planos Curriculares
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                        Alunos
                    </a>
                    <div class="sb-sidenav-menu-heading">Gestão</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                       data-bs-target="#collapseCurricular" aria-expanded="false"
                       aria-controls="collapseCurricular">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Curricular
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
{{--                    <div class="collapse" id="collapseCurricular" aria-labelledby="headingOne"--}}
{{--                         data-bs-parent="#sidenavAccordion">--}}
{{--                        <nav class="sb-sidenav-menu-nested nav">--}}
{{--                            <a class="nav-link {{ Route::currentRouteName() == 'cursos.index' ? 'active' : '' }}"--}}
{{--                               href="{{ route('cursos.index') }}">Cursos</a>--}}
{{--                            <a class="nav-link {{ Route::currentRouteName() == 'disciplinas.index' ? 'active' : '' }}"--}}
{{--                               href="{{ route('disciplinas.index') }}">Disciplinas</a>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                       data-bs-target="#collapseRecursosHumanos" aria-expanded="false"
                       aria-controls="collapseRecursosHumanos">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Recursos Humanos
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRecursosHumanos" aria-labelledby="headingTwo"
                         data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="#">Departamentos</a>
                            <a class="nav-link" href="#">Docentes</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Candidaturas</div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                        Enviar candidatura
                    </a>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Candidaturas
                    </a>
                    <div class="sb-sidenav-menu-heading">Espaço Privado</div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-text"></i></div>
                        Minhas disciplinas
                    </a>
                </div>
            </div>
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
