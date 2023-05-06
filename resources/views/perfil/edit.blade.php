@extends('layout')
@section('title','Change Profile')
@section('content')
    <form method="POST" action="{{ route('perfil.update', ['customer' => $customer]) }}" class="form-group" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$customer->id}}">
        @include('perfil.partials.create-edit')
        @isset($cliente->userRef->photo_url)
            <div class="form-group">
                <img src="{{$cliente->userRef->photo_url ? asset('storage/photos/' . $customer->userRef->photo_url) : asset('img/default_img.png') }}" alt="Foto do cliente"  class="img-profile" style="max-width:100%">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($cliente->userRef->photo_url)
                <button type="submit" class="btn btn-danger" name="deletephoto" form="form_delete_photo">Apagar Foto</button>
            @endisset
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{ route('perfil.index', ['customer' => $customer]) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{ route('perfil.photo.destroy', ['customer' => $customer]) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
