@extends('layout')
@section('title', 'Nova Categoria' )
@section('main')
    <form method="POST" action="{{route('categorias.store')}}" class="form-group">
        @csrf
        @include('categorias.shared.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('categorias.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
