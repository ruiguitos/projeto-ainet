@extends('layout')
@section('titulo', 'Editar Utilizador' )
@section('main')
    <form method="POST" action="{{route('users.empregados.shared.store')}}" class="form-group">
        @csrf
        @include('users.empregados.shared.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            {{--            <a href="{{route('users.admins.index')}}" class="btn btn-secondary">Cancel</a>--}}
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
