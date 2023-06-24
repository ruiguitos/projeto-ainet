@extends('layout')
@section('titulo', 'Estampa Personalizada -- TODO')
@section('main')

    <div class="container-fluid">
        <div class="centered-container" style="display: flex; justify-content: center; align-items: center; height: 50vh;">
            <form action="{{ route('catalogo.estampa') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="photo" accept=".jpg, .jpeg, .png">
                <button type="submit" class="btn btn-primary btn-sm" style="border-color: black">
                    Upload a Estampa Nova
                </button>
            </form>
        </div>

        @if(session('image_path'))
            <div class="centered-container" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{ URL::asset('storage/estampas/' . session('image_path')) }}" alt="Uploaded Image" style="max-width: 100%;">
            </div>
        @endif
    </div>




@endsection
