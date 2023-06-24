@extends('layout')
@section('titulo', 'Detalhes da T-Shirt')
@section('subtitulo')

    <div class="container-fluid">
        <br>
        <div class="price-details" style="display: flex; justify-content: center;">
            @foreach($prices as $price)
                <div class="price">
                    <div>
                        <strong>Title: </strong>
                        {{ $tshirt_images->name }}
                    </div>
                    <br>
                    <div>
                        <img src="{{ asset('storage/tshirt_images/' . $tshirt_images->image_url) }}" style="height: 15rem; width: 15rem; border: 5px">
                    </div>
                    <br>
                    <div>
                        <strong>Original Price: </strong>
                        {{ $price->unit_price_catalog }}€
                    </div>
                    <br>
                    <div>
                        <strong>Discount: </strong>
                        {{ $price->unit_price_catalog_discount }}%
                    </div>
                    <br>
                    <div>
                        <strong>Unit price: </strong>
                        {{ $price->unit_price_own }}€
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <div style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: white; display: flex; justify-content: center; align-items: center; padding: 15px;">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial</a>
        </div>
    </div>


@endsection
