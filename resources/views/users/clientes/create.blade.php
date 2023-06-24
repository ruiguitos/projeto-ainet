@extends('layout')
@section('titulo', 'Novo Utilizador' )
@section('main')
    <form method="POST" action="{{route('users.clientes.shared.store')}}" class="form-group">
        @csrf
        @include('users.clientes.shared.create-edit')
        <br>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
{{--            <a href="{{route('users.admins.index')}}" class="btn btn-secondary">Cancel</a>--}}
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>

        </div>
    </form>
@endsection
