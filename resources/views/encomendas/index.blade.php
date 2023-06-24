@extends('layout')
@section('titulo','Encomendas')
@section('subtitulo')

    @yield('subtitulo')
    <div class="mt-4">
        @yield('main')
    </div>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Encomendas</li>
    </ol>

    <div style="display: flex; justify-content: flex-end;">
        <a href="{{ route('encomendas.shared.create') }}" class="btn btn-success btn-m" role="button"
           aria-pressed="true">Adicionar Nova Encomenda</a>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>ID Encomenda</th>
            <th>Customer ID</th>
            <th>Data</th>
            <th>Preço Total</th>
            <th>Notas</th>
            <th>NIF</th>
            <th>Endereço</th>
            <th>Tipo Pagamento</th>
            <th>Referência Pagamento</th>
            <th>Receita</th>
            <th>Status Encomenda</th>
            <th></th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ $order->total_price }} €</td>
                @if($order->notes == '')
                    <td> Sem notas adicionadas</td>
                @else
                    <td> {{ $order->notes }} </td>
                @endif
                <td>{{ $order->nif }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->payment_type }}</td>
                <td>{{ $order->payment_ref }}</td>
                @if($order->receipt_url == NULL)
                    <td> S/ Receita</td>
                @else
                    <td> C/ Receita</td>
                @endif
                <td>{{ $order->status }}</td>
                <td>
{{--                    <form id="toggleForm" action="{{ route('encomendas.index', ['encomenda' => $order->id]) }}" method="POST"--}}
{{--                          style="display: inline;">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}
{{--                        <button type="submit" class="btn {{ $order->status ? 'btn-info' : 'btn-warning' }}">--}}
{{--                            {{ $order->status ? 'Fechada' : 'Cancelada' }}--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                    <form action="{{ route('encomendas.index', ['id' => $order->id]) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}
{{--                        <select name="status">--}}
{{--                            <option value="canceled">Cancelado</option>--}}
{{--                            <option value="closed">Fechado</option>--}}
{{--                        </select>--}}
{{--                        <button type="submit">Atualizar Status</button>--}}
{{--                    </form>--}}
                    <form action="{{ route('encomendas.index', ['id' => $order->status]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn {{ $order->status ? 'btn btn-outline-secondary' : 'btn btn-outline-secondary' }}">
                            {{ $order->status  ? 'Fechada' : 'Cancelada' }}
                        </button>
                    </form>
                </td>

                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{route('encomendas.shared.edit', ['encomenda' => $order]) }}"
                           class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                        @can('delete', $order)
                            <form action="{{route('encomendas.shared.destroy', ['encomenda' => $order]) }}"
                                  method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        @endcan
                        <form action="{{route('encomendas.shared.destroy', ['encomenda' => $order]) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form>
                    </div>
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

                                        @if (Auth::user()->user_type == 'A')
                                            <a class="nav-link" href="/dashboard">
                                                <div class="sb-nav-link-icon"><i class="fa fa-tachometer"
                                                                                 aria-hidden="true"></i></div>
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
                    </div>
                </div>
            </div>

            <div
                style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
                <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                    Inicial
                </a>
            </div>

            <footer>{{ $orders->links() }}</footer>
@endsection
