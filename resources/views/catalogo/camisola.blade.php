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
            @foreach ($tshirt as $tshirt)
                <div class="tshirt-container">
                    <p>
                        <img src="{{ asset('storage/tshirt_images' . $tshirt->image_url) }}"
                             style="height: 15rem; width: 15rem; border: 5px">
                    </p>

                    <div class="price">
                        <p><strong>Price:</strong> {{ $tshirt->unit_price }}€</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
            <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                Inicial
            </a>
        </div>

        {{--        <footer>{{ $tshirt->links() }}</footer>--}}
    </div>
@endsection
