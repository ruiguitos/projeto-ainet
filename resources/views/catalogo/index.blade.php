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
            @foreach ($tshirt_images as $tshirt)
                <div class="tshirt-item">
                    <p>
                        <a href="{{ route('catalogo.show', $tshirt->id) }}">
                            <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" style="height: 15rem; width: 15rem; border: 5px">
                        </a>
                      <p><strong>{{ $tshirt->name }}</strong></p>
                    </p>

                    <div class="description">
                        <p>
                            <strong>Description:</strong> {{ $tshirt->description }}
                        </p>
                    </div>
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
@endsection

{{--@extends('layout')--}}
{{--@section('subtitulo')--}}

{{--    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">--}}

{{--    <div class="container-fluid">--}}
{{--        <div class="search-container">--}}
{{--            <div class="search-bar">--}}
{{--                <form action="{{ route('catalogo.index') }}" method="GET">--}}
{{--                    <input type="text" name="search" placeholder="Search by Name">--}}
{{--                    <button type="submit">Search</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="grid-container">--}}
{{--            @foreach ($tshirt_images as $tshirt)--}}
{{--                <div class="tshirt-item">--}}
{{--                    <div class="tshirt-image">--}}
{{--                        <a href="{{ route('catalogo.show', $tshirt->id) }}">--}}
{{--                            <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" alt="T-Shirt Image">--}}
{{--                            <p>{{ $tshirt->name }}</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class="description">--}}
{{--                        <p>--}}
{{--                            <strong>Description:</strong> {{ $tshirt->description }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    --}}{{--                    <div class="category">--}}
{{--                    --}}{{--                        <p>--}}
{{--                    --}}{{--                            Category: {{ $tshirt->category_id }}--}}
{{--                    --}}{{--                        </p>--}}
{{--                    --}}{{--                    </div>--}}
{{--                    @foreach($prices as $price)--}}
{{--                        <div class="price">--}}
{{--                            <p> <strong>Price:</strong> {{ $price->unit_price_catalog }}€</p>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    <div class="add-to-cart">--}}
{{--                        <form action="{{ route('carrinho.add', $tshirt->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="rounded-button">Add to Cart</button>--}}
{{--                        </form>--}}
{{--                        <div class="add-quantity">--}}
{{--                            <label for="quantity">Quantity: </label>--}}
{{--                            <input type="number" id="quantity" name="quantity" min="1" value="1">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--        <div class="footer">--}}
{{--            <!-- Footer content goes here -->--}}
{{--            {{ $tshirt_images->links() }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


