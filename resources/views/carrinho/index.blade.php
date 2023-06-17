@extends('layout')
@section('title', 'Carrinho')

@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{  $details['photo'] ? asset('public/tshirt_base/' . $details['photo']) : asset('img/plain_white.png')}}" width="100" height="100" class="img-responsive">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{ $details['price'] }}€</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity">
                    </td>
                    <td data-th="Tamanho">{{ $details['tamanho'] }}</td>
                    <td data-th="Color">{{ $details['color'] }}</td>
                    <td data-th="Subtotal" class="text-center">{{ $details['price'] * $details['quantity'] }}€</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
{{--        <td class="hidden-xs text-right" text-align: right><strong>Desconto {{ $desconto }}€</strong></td>--}}
        <tr>
            <td><a href="{{ url('/home') }}"><i class="fa fa-angle-left"></i> Continuar Compras</a></td>
            <td><a href="{{ url('/pagamento') }}"><i class="fa fa-angle-right"></i> Finalizar</a></td>
            <td colspan="2" class="hidden-xs"></td>
{{--            <td class="hidden-xs text-center"><strong>Total {{ $total_price }}€</strong></td>--}}
        </tr>

        </tfoot>
    </table>

    <script type="text/javascript">
        $(".update-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Tem a certeza que pretende remover o produto?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
    <footer>
        <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black; align-items: flex-end">Voltar à Pagina Inicial</a>
    </footer>
@endsection
