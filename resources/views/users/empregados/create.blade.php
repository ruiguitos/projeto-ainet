@extends('layout')
@section('titulo', 'Novo Utilizador' )

@section('main')
    <form method="POST" action="{{route('users.empregados.shared.store')}}" class="form-group" enctype="multipart/form-data">
        @csrf
        @include('users.empregados.shared.create-edit')
        <br>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
{{--            <a href="{{route('users.admins')}}" class="btn btn-secondary">Cancel</a>--}}
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
        </div>
        <br>
    </form>
@endsection
