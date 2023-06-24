@extends('layout')
@section('titulo','Catálogo')
@section('main')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <div class="container-fluid">
        <div class="search-container">
            <form action="{{ route('catalogo.index') }}" method="GET" class="form-group">
                <input type="text" name="search" placeholder="Search by Name">
                <select name="orderBy">
                    <option value="name">Order by Name</option>
                    <option value="price">Order by Price</option>
                </select>
                <select name="orderDirection">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
            </form>
        </div>

{{--            <div class="search-container">--}}
{{--                <form method="GET" action="{{route('catalogo.index')}}" class="form-group">--}}
{{--                    <div class="input-group">--}}
{{--                        <select class="custom-select" name="category" id="inputCategory" aria-label="Category">--}}
{{--                            <option value="" {{'' == old('category', $id) ? 'selected' : ''}}>Todas as Categorias</option>--}}
{{--                            @foreach ($categories as $abr => $name)--}}
{{--                                <option value={{$abr}} {{$abr == old('categoria', $id) ? 'selected' : ''}}>{{$name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <input type='text' class="form-control" name="search" placeholder="Procurar Nome">--}}
{{--                        <input type='text' class="form-control" name="searchDesc" placeholder="Procurar Descrição">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

        <div class="grid-container">
            @foreach ($tshirt_images as $tshirt)
                <div class="tshirt-container">
                    <p>
                        <a href="{{ route('catalogo.details', $tshirt->id) }}">
                            <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}"
                                 style="height: 15rem; width: 15rem; border: 5px">
                        </a>
                    <p>
                        <strong>{{ $tshirt->name }}</strong></p>
                    </p>

                    <div class="description">
                        <p>
                            <strong>Description:</strong> {{ $tshirt->description }}
                        </p>
                    </div>
                    @foreach($prices as $price)
                        <div class="price">
                            <p><strong>Price:</strong> {{ $price->unit_price_catalog }}€</p>
                        </div>
                    @endforeach
                    <div class="add-to-cart">
                        <form action="{{ route('cart.add', $tshirt->id) }}" method="POST">
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

        <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
            <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                Inicial
            </a>
        </div>

        <footer>{{ $tshirt_images->links() }}</footer>

@endsection
