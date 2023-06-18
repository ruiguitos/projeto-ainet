@extends('layout')
@section('title','Empregados' )
@section('main')

    <title class="Empregados"></title>


    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>User type</th>
            <th>Estado</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->user_type == "E")
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_type }}</td>
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
@endsection
