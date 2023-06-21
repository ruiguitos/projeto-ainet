@extends('layout')
@section('subtitulo')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container-fluid">
        <div class="search-container">
            <form action="{{ route('catalogo.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search by Name">
                <select name="orderBy">
                    <option value="name">Order by Name</option>
                    <option value="price">Order by Price</option>
                </select>
                <select name="orderDirection">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="grid-container">
            {{--            @foreach ($tshirts as $tshirt)--}}
            {{--                <div class="tshirt-container">--}}
            {{--                    <p>--}}
            {{--                        <img src="{{ asset('storage/tshirt_images' . $tshirt->image_url) }}"--}}
            {{--                             style="height: 15rem; width: 15rem; border: 5px">--}}
            {{--                    </p>--}}

            {{--                    <div class="price">--}}
            {{--                        <p><strong>Price:</strong> {{ $tshirt->unit_price }}€</p>--}}
            {{--                    </div>--}}

            {{--                    <div class="size">--}}
            {{--                        <p><strong>Price:</strong> {{ $tshirt->size }}</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endforeach--}}

            {{--            @foreach ($tshirts as $tshirt)--}}
            {{--                <div class="tshirt-container">--}}
            {{--                    <p>--}}
            {{--                        <img src="{{ asset('storage/tshirt_base/' . $tshirt->color_code) }}"--}}
            {{--                             style="height: 15rem; width: 15rem; border: 5px">--}}
            {{--                    </p>--}}

            {{--                    <div class="price">--}}
            {{--                        <p><strong>Price:</strong> {{ $tshirt->unit_price }}€</p>--}}
            {{--                    </div>--}}

            {{--                    <div class="size">--}}
            {{--                        <p><strong>Price:</strong> {{ $tshirt->size }}</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endforeach--}}
            @foreach ($tshirts as $tshirt)
                <div class="tshirt-container">
                    <p>
                        <a>
                            <img src="{{ asset('storage/tshirt_base/' . $tshirt->color_code . '.jpg') }}"
                                 style="height: 15rem; width: 15rem; border: 5px">
                        </a>
                        {{--                    <p><strong>{{ $tshirt->size }}</strong></p>--}}
                    </p>

                    <div class="Tamanho">
                        <p>
                            <strong>Tamanho: {{ $tshirt->size }}</strong>
                        </p>
                    </div>
                    @foreach($prices as $price)
                        <div class="price">
                            <p><strong>Price:</strong> {{ $price->unit_price_catalog }}€</p>
                        </div>
                        {{--                    POR IMPLEMENTAR--}}
                    @endforeach
                    <div class="add-to-cart">
                        <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-button">Add to Cart</button>
                        </form>
                        <div class="add-quantity">
                            {{--                            <label for="quantity">Quantity: </label>--}}
                            {{--                            <input type="number" id="quantity" name="quantity" min="1" value="1">--}}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="add-to-cart">
                <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-button">Add to Cart</button>
                </form>
                {{--                    <div class="add-quantity">--}}
                {{--                        <label for="quantity">Quantity: </label>--}}
                {{--                        <input type="number" id="quantity" name="quantity" min="1" value="1">--}}
                {{--                    </div>--}}
            </div>
        </div>

        <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
            <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                Inicial
            </a>
        </div>

{{--        <footer>        {{ $tshirt->withQueryString()->links() }}     </footer>--}}
    </div>
@endsection
