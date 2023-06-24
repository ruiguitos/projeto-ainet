@extends('layout')
@section('title', 'Carrinho')
@section('main')

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs">
                                            @if(isset($details['photo_url']))
                                                <img src="{{ asset('storage/tshirt_images/' . $details['photo_url']) }}" width="100" height="100" class="img-responsive">
                                            @else
                                                <img src="{{ asset('img/plain_white.png') }}" width="100" height="100" class="img-responsive">
                                            @endif
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $details['price'] }}€</td>
                                <td>
                                    <input type="number" value="{{ $details['quantity'] }}"
                                           class="form-control quantity">
                                </td>
                                <td>{{ $details['size'] }}</td>
                                @if(isset($details['color_code']))
                                    <td data-th="Color">{{ $details['color_code'] }}</td>
                                @else
                                    <td data-th="Color">N/A</td>
                                @endif
                                <td class="text-center">
                                    @if(isset($details['unit_price']))
                                        {{ $details['unit_price'] * $details['quantity'] }}€
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm update-cart"
                                            data-id="{{ $id }}"><i class="fa fa-refresh"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm remove-from-cart"
                                            data-id="{{ $id }}"><i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <td class="hidden-xs text-right" text-align: right>
                        <strong>Desconto {{ $desconto }}€</strong></td>
                    <tr>
                        <td><a href="{{ url('/catalogo') }}" class="btn btn-primary"><i
                                    class="fa fa-angle-left"></i> Continuar Compras</a></td>
                        <td><a href="{{ url('/pagamento') }}" class="btn btn-primary"><i
                                    class="fa fa-angle-right"></i> Finalizar</a></td>
                        <td colspan="2" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong>Total {{ $total }}€</strong></td>
                    </tr>
                </table>
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<script type="text/javascript">
    $(".update-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ url('update-cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if (confirm("Tem a certeza que pretende remover o produto?")) {
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

@endsection
