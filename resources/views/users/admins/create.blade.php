@extends('layout')
@section('titulo', 'Novo Utilizador' )
@section('main')

{{--    <form method="POST" action="{{route('users.admins.shared.store')}}" class="form-group">--}}
{{--        @csrf--}}
{{--        @include('users.admins.shared.create-edit')--}}
{{--        <div class="form-group text-right">--}}
{{--            <br>--}}
{{--            <button type="submit" class="btn btn-success" name="ok">Save</button>--}}
{{--            <a href="{{ route('users.admins.index', ['id' => $id]) }}" class="btn btn-secondary">Cancel</a>--}}
{{--        </div>--}}
{{--    </form>--}}

<form method="POST" action="{{ route('users.admins.shared.store') }}" class="form-group">
    @csrf
    @include('users.admins.shared.create-edit')
    <div class="form-group text-right">
        <br>
        <button type="submit" class="btn btn-success" name="ok">Save</button>
{{--        <a href="{{ route('users.admins.index', ['id' => $id]) }}" class="btn btn-secondary">Cancel</a>--}}
        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
