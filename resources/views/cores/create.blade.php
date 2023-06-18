@extends('layout')
@section('title', 'Nova Cor' )
@section('main')
    <form method="POST" action="{{route('cores.store')}}" class="form-group">
        @csrf
        @include('cores.shared.create-edit')
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a href="{{route('cores.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
