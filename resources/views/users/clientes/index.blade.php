@extends('layout')
@section('main')

    <h1 class="mt-4">@yield('titulo', 'Clientes')</h1>
    @yield('subtitulo')
    <div class="mt-4">
        @yield('main')
    </div>

    <ol class="breadcrumb">
{{--        <li class="breadcrumb-item">Dashboard</li>--}}
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Estado</th>
            <th></th>
            <th>Actions</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
{{--                @if($user->blocked == 1)--}}
{{--                    <td> Bloqueado </td>--}}
{{--                @else--}}
{{--                    <td> Ativo </td>--}}
{{--                @endif--}}
                <td>
                    <form id="toggleForm" action="{{ route('users.clientes.index', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn {{ $user->blocked ? 'btn-info' : 'btn-warning' }}">
                            {{ $user->blocked ? 'Desativado' : 'Ativado' }}
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{route('encomendas.create')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Novo</a>
                </td>
                <td>
                    <a href="{{route('users.clientes.edit', ['cliente' => $user]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                <td>
                    @can('delete', $user)
                        <form action="{{route('users.clientes.destroy', ['cliente' => $user]) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form>
                    @endcan
                </td>
                <td>
                    <form action="{{route('users.clientes.destroy', ['cliente' => $user]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <br>
                @yield('subtitulo')
                <div class="mt-4">
                    @yield('main')
                    <div id="layoutSidenav">
                        <div id="layoutSidenav_nav">
                            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                                <div class="sb-sidenav-menu">
                                    <div class="nav">
                                        <div class="sb-sidenav-menu-heading">Core</div>
                                        <a class="nav-link" href="/home">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney"></i>
                                            </div>
                                            Homepage
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

                                        <a class="nav-link" href="/dashboard/charts">
                                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                            Gráficos
                                        </a>
                                        <a class="nav-link" href="/dashboard/tables">
                                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                            Dados
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
                    </div>
                </div>
            </div>

    <footer>
        {{ $users->links() }}
    </footer>
@endsection
