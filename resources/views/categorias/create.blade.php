@extends('user.index')

@section('user_info')
    @if (session('alert-msg'))
        @include('partials.message')
    @endif
    @if ($errors->any())
        @include('partials.errors-message')
    @endif
    <form method="POST" action="{{ route('user.edit', ['user' => $user]) }}" class="form-group"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('user.partials.create-edit')
        @isset($user->foto_url)
            <div class="form-group">
                <img src="{{ $user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('images/default_img.png') }}"
                     alt="Foto do user" class="img-profile" style="max-width:100%" height="250px">
            </div>
        @endisset
        <div class="form-group text-right">
            @isset($user->foto_url)
                @can('update', $user)
                    <button type="submit" class="btn btn-danger" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                @endcan
            @endisset
            @can('update', $user)
                <button type="submit" class="btn btn-primary" name="ok">Alterar</button>
            @endcan
            <a href="" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <form id="form_delete_photo" action="{{ route('user.foto.destroy', ['user' => $user]) }}"
          onsubmit="return confirm('Tem a certeza que deseja apagar a photo?')" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
