@extends('layout')
{{--@section('title','Cor' )--}}
@section('main')

    <div class="container-fluid px-4">
        <h1 class="mt-4">@yield('titulo', 'Administradores')</h1>
        @yield('subtitulo')
        <div class="mt-4">
            @yield('main')
        </div>
    </div>

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>User type</th>
            <th>Estado</th>
            <th>Actions </th>
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
                    <td>
                        <form id="toggleForm" action="{{ route('users.admins.index', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn {{ $user->blocked ? 'btn-success' : 'btn-danger' }}">
                                {{ $user->blocked ? 'Unblock' : 'Block' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#toggleForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
