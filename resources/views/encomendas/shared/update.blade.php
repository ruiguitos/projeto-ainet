@extends('layout')
@section('title', 'Nova Encomenda' )
@section('main')
    <form method="POST" action="{{route('encomendas.store')}}" class="form-group">
        @csrf
        @include('encomendas.shared.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('encomendas.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
