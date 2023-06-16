@extends('layout')

@section('subtitulo')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container-fluid">
        <div class="search-container">
            <div class="search-bar">
                <form action="{{ route('catalogo.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Search by Name">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <div class="grid-container">
            @foreach ($tshirt_images as $tshirt)
                <div class="tshirt-item">
                    <div class="tshirt-image">
                        <a href="{{ route('catalogo.show', $tshirt->id) }}">
                            <p>{{ $tshirt->name }}</p>
                        </a>
                        {{$tshirt->image_url}}

                    </div>

                    <div class="description">
                        <p>
                            <strong>Description:</strong> {{ $tshirt->description }}
                        </p>
                    </div>
                    {{--                    <div class="category">--}}
                    {{--                        <p>--}}
                    {{--                            Category: {{ $tshirt->category_id }}--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                    @foreach($prices as $price)
                        <div class="price">
                            <p> <strong>Price:</strong> {{ $price->unit_price_catalog }}€</p>
                        </div>
                    @endforeach
                    <div class="add-to-cart">
                        <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-button">Add to Cart</button>
                        </form>
                        <div class="add-quantity">
                            <label for="quantity">Quantity: </label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="footer">
            <!-- Footer content goes here -->
            {{ $tshirt_images->links() }}
        </div>
    </div>
@endsection



