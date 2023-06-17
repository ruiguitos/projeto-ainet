@extends('layout')

@section('subtitulo')

    <h2> Detalhes da T-Shirt</h2>

    <div class="container-fluid">
        <div class="price-details">
            @foreach($prices as $price)
                <div class="price" style="align-items: stretch">
                    <div>
                        <strong>Title: </strong>
                        {{ $tshirt_images->name }}
                    </div>
                    <div>
                        <strong>Original Price: </strong>
                        {{ $price->unit_price_catalog }}€
                    </div>
                    <div>
                        <strong>Discount: </strong>
                        {{ $price->unit_price_catalog_discount }}%
                    </div>
                    <div>
                        <strong>Unit price: </strong>
                        {{ $price->unit_price_own }}€
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <footer>
        <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black; align-items: flex-end; margin-top: 15px\\">Voltar à Pagina Inicial</a>
    </footer>
@endsection
