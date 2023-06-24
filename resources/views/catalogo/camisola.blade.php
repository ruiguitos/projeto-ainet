@extends('layout')
@section('titulo','Camisolas')
@section('main')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="order-by">
        <label for="order-select">Tamanhos:</label>
        <select id="order-select" name="order" onchange="this.form.submit()">
            @foreach ($sizes as $size)
                <option value="{{ $size }}" {{ Request::get('order') == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid-container">
        @foreach ($tshirts->sortBy(Request::get('order', 'desc')) as $tshirt)
            <div class="tshirt-container">
                <p>
                    <a>
                        <img src="{{ asset('storage/tshirt_base/' . $tshirt->color_code . '.jpg') }}"
                             style="height: 15rem; width: 15rem; border: 5px">
                    </a>
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
                @endforeach
                <div class="add-to-cart">
                    <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-button">Add to Cart</button>
                    </form>
                </div>
            </div>

            @php
                $sizes = ['S', 'M', 'L', 'XL', 'XXL']; // Array of available t-shirt sizes
            @endphp

            @foreach ($sizes as $size)
                <div class="tshirt-container">
                    <p>
                        <a>
                            <img src="{{ asset('storage/tshirt_base/' . $tshirt->color_code . '.jpg') }}"
                                 style="height: 15rem; width: 15rem; border: 5px">
                        </a>
                    </p>

                    <div class="Tamanho">
                        <p>
                            <strong>Tamanho: {{ $size }}</strong>
                        </p>
                    </div>
                    @foreach($prices as $price)
                        <div class="price">
                            <p><strong>Price:</strong> {{ $price->unit_price_catalog }}€</p>
                        </div>
                    @endforeach
                    <div class="add-to-cart">
                        <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-button">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    <br>
    <br>
    <br>
    <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
        <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial
        </a>
    </div>

    <footer>
        {{ $tshirts->links() }}
    </footer>
    </div>
@endsection
