@extends('layout')
@section('titulo', 'Apagar Utilizador' )
@section('main')
    <form method="POST" action="{{route('users.clientes.store')}}" class="form-group">
        @csrf
        @include('admins.shared.create-edit')
        <div class="form-group text-right">
            <br>
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('users.clientes.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
