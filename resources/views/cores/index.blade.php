@extends('layout')

@section('main')

    <h2>Cores</h2>
    <div class="genero-area">
{{--        @foreach($colors as $color)--}}
{{--            <div class="genero">--}}
{{--                <div class="genero-info-area">--}}
{{--                    <div class="genero-info">--}}
{{--                        <span class="genero-label">Codigo</span>--}}
{{--                        <span class="genero-info-desc">{{$color->code}}</span>--}}
{{--                    </div>--}}
{{--                    <div class="genero-info">--}}
{{--                        <span class="genero-label">Nome</span>--}}
{{--                        <span class="genero-info-desc">{{$color->name}}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>
    <br>

    <center>
        <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial</a>
    </center>

@endsection
