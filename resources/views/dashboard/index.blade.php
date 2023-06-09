@extends('layout')
@section('titulo','Administração')
@section('subtitulo')

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand " href="{{ route('home') }}">
            <img src="/img/plain_white.png" alt="Logo" class="bg-dark" width="50" height="50">
            ImagineShirt
        </a>

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
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img
                            src="{{Auth::user()->photo_url ? asset('storage/photos/' . Auth::user()->photo_url) : asset('img/default_img.png') }}"
                            alt="Imagem do Cliente" class="img-profile rounded-circle" height="45">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/password/reset">Alterar Senha</a></li>
                        <li><a class="dropdown-item" href="/carrinho">Carrinho</a></li>
                        <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
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

                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/home">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney"></i></div>
                            Homepage
                        </a>

                        @if (Auth::user()->user_type == 'A')
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
                                Admin Dashboard
                            </a>

                            <div class="sb-sidenav-menu-heading">Área de Gestão</div>
                            <a class="nav-link" href="/categorias">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Categorias
                            </a>

                            <a class="nav-link" href="/cores">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Cores
                            </a>
                            <a class="nav-link" href="/encomendas">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Encomendas Registadas
                            </a>

                            <a class="nav-link" href="/encomendas">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Status Encomendas
                            </a>

                        @endif
                        @if (Auth::user()->user_type == 'E')
                            <a class="nav-link" href="/encomendas">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Encomendas Registadas
                            </a>

                            <a class="nav-link" href="/encomendas">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                Status Encomendas
                            </a>
                        @endif
                        @if (Auth::user()->user_type == 'A')
                            <a class="nav-link" href="/dashboard/charts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Gráficos
                            </a>

                            <div class="sb-sidenav-menu-heading">Utilizadores</div>
                            <a class="nav-link" href="/users/admins">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i>
                                </div>
                                Administradores
                            </a>

                            <a class="nav-link" href="/users/clientes">
                                <div class="sb-nav-link-icon"><i class="fas fa fa-users"></i></div>
                                Clientes
                            </a>

                            <a class="nav-link" href="/users/empregados">
                                <div class="sb-nav-link-icon"><i class="fas fa fa-users"></i></div>
                                Empregados
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">
                        <strong>Logged in as:</strong>
                    </div>
                    @php
                        $fullName = Auth::user()->name;
                        $nameParts = explode(' ', $fullName);
                        $firstName = $nameParts[0];
                        $lastName = count($nameParts) > 1 ? $nameParts[count($nameParts) - 1] : '';
                    @endphp
                    {{ $firstName }} {{ $lastName }}
                    <div class="small" style="margin-top: 10px">
                        <strong>User type:</strong>
                        @php
                            $userType = Auth::user()->user_type;
                            $userTypeMeanings = [
                                'A' => 'Administrador',
                                'E' => 'Empregado',
                            ];
                        @endphp
                        {{ isset($userTypeMeanings[$userType]) ? $userTypeMeanings[$userType] : 'Unknown' }}
                    </div>
                </div>
            </nav>
        </div>

        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Administração</li>
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            </ol>
            <br>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Estatisticas Totais da Loja</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link">FALTAM OS GRAFICOS ASSOCIADOS</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" >
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Administradores:
                            {{$ausers}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Empregados:
                            {{$eusers}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Clientes:
                            {{$cusers}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Categorias:
                            {{$ncategorias}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Cores:
                            {{$ncores}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Total de Encomendas:
                            {{$nTotalEncomendas}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Número de Encomendas Canceladas:
                            {{$nEncomendasCanceladas}}
                        </div>
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Numero de Encomendas Fechadas:
                            {{$nEncomendasFechadas}}
                        </div>
                    </div>
                </div>

            </div>

            </div>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        @vite('resources/js/app.js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
        <script src="resources/demo/chart-area-demo.js"></script>
        <script src="resources/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        </body>
    </div>

@endsection
