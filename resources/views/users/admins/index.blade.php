@extends('layout')


@section('title','Cor' )
@section('main')

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

            @if($user->user_type == "A")
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
{{--                    <td>--}}
{{--                        <a href="{{route('users.admins.edit', ['user' => $user]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>--}}
{{--                    <td>--}}
{{--                    <td>--}}
{{--                        <form action="{{route('users.admins.destroy', ['user' => $user]) }}" method="POST">--}}
{{--                            @crsf--}}
{{--                            @method("DELETE")--}}
{{--                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">--}}
{{--                        </form>--}}
{{--                    </td>--}}
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection

