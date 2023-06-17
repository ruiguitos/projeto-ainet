@extends('layout')

@section('content')
    <h1>Clients</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <!-- Add more columns as needed -->
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <!-- Display additional columns as needed -->
            </tr>
        @endforeach
        </tbody>
    </table>

    <br>
    <center><a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial</a>
    </center>

    {{ $clients->links() }}
@endsection
