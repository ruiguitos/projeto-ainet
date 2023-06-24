@extends('layout')
@section('titulo','Encomendas')
@section('main')

    {{--    <ol class="breadcrumb">--}}
    {{--        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>--}}
    {{--        <li class="breadcrumb-item active">Encomendas</li>--}}
    {{--    </ol>--}}


    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>data</th>
            <th>preço total</th>
            <th>endereço</th>
            <th>tipo de pagamento</th>
        </tr>
        </thead>
        <tbody>
        @foreach($encomendas as $encomenda)
            <tr>
                <td>{{ $encomenda->id }}</td>
                <td>{{ $encomenda->status }}</td>
                <td>{{ $encomenda->date }}</td>
                <td>{{ $encomenda->total_price }} €</td>
                <td>{{ $encomenda->address }}</td>
                @if($encomenda->payment_type == 'MC')
                    <td> MasterCard</td>
                @else()
                    <td>{{ $encomenda->payment_type }}</td>
                @endif

            </tr>
        @endforeach

        </tbody>
    </table>
    <br>
    <br>
    <br>
    <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
        <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial
        </a>
    </div>

    <footer>
        {{ $encomendas->links() }}
    </footer>
@endsection
