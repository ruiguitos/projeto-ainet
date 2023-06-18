@extends('layout')
@section('title','Cor' )
@section('main')

    <title class="Clientes"></title>

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
            @if($user->user_type == "C")
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
            @endif
        @endforeach

        </tbody>
    </table>

    <footer>{{ $users->links() }}</footer>

@endsection
