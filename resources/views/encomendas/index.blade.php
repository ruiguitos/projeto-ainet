@extends('layout')
@section('subtitulo')

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th>ID Encomenda</th>
            <th>Status Encomenda</th>
            <th>Customer ID</th>
            <th>Data</th>
            <th>Preço Total</th>
            <th>Notas</th>
            <th>NIF</th>
            <th>Endereço</th>
            <th>Tipo Pagamento</th>
            <th>Referência Pagamento</th>
            <th>Receita</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)

                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->customer_id }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->total_price }} €</td>
                    @if($order->notes == '')
                        <td> Sem notas adicionadas </td>
                    @else
                        <td> {{ $order->notes }} </td>
                    @endif
                    <td>{{ $order->nif }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->payment_type }}</td>
                    <td>{{ $order->payment_ref }}</td>
                    @if($order->receipt_url == NULL)
                        <td> S/ Receita </td>
                    @else
                        <td> C/ Receita </td>
                    @endif
                    <td>
                        <a href="{{route('encomendas.edit', ['encomenda' => $order]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                    <td>
                        @can('delete', $order)
                            <form action="{{route('encomendas.destroy', ['encomenda' => $order]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        @endcan

                            <form action="{{route('encomendas.destroy', ['encomenda' => $order]) }}" method="POST">
                                @method("DELETE")
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>

                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

        <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
            <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                Inicial
            </a>
        </div>

        <footer>{{ $orders->links() }}</footer>
@endsection
