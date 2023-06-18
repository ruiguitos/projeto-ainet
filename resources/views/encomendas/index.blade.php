@extends('layout')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('subtitulo')



    <div style="margin-top: 15px; margin-bottom: 15px; display: flex; justify-content: center; position: inherit">
        <a href="{{ url()->previous() }}" class="btn btn-default" style="border-color: black">Voltar à Pagina
            Inicial
        </a>
    </div>


@endsection
