@extends('layout')
{{--@section('title','Cor')--}}

@section('main')

    <div class="container-fluid px-4">
        <h1 class="mt-4">@yield('titulo', 'Clientes')</h1>
        @yield('subtitulo')
        <div class="mt-4">
            @yield('main')
        </div>
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if($user->blocked == 1)
                    <td> Bloqueado </td>
                @else
                    <td> Ativo </td>
                @endif
                <td>
                    <form id="toggleForm" action="{{ route('users.clientes.index', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn {{ $user->blocked ? 'btn-success' : 'btn-danger' }}">
                            {{ $user->blocked ? 'Unblock' : 'Block' }}
                        </button>
                    </form>
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
                        @crsf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <footer>{{ $users->links() }}</footer>

@endsection
