@extends('layout')

@section('content')
    <h1>Lista de Clientes</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <!-- Add more columns as needed -->
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <!-- Add more columns as needed -->
            </tr>
        @endforeach
        </tbody>
    </table>

    <footer>
        <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black; align-items: flex-end">Voltar à
            Pagina Inicial</a>
    </footer>

@endsection



