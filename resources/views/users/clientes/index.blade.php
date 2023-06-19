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
            </tr>
        @endforeach

        </tbody>
    </table>

    <footer>{{ $users->links() }}</footer>

@endsection
