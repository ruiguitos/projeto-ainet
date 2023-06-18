@extends('layout')
@section('title', 'Novo Administrador' )
@section('main')
    <form method="POST" action="{{route('users.admins.store')}}" class="form-group">
        @csrf
        @include('admins.shared.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('users.admins.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
