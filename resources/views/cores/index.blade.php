@extends('layout')
@section('title','Cor' )
@section('main')
    <div class="row mb-3">
        <div class="col-3">
            <a  href="{{route('cores.create')}}" class="btn btn-success" role="button" aria-pressed="true">Adicionar Nova Cor</a>
        </div>
    </div>

    <table class="table table-sm">
        <thead class="thead-dark">
        <tr>
            <th>Código da Cor</th>
            <th>Nome da Cor</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($colors as $cor)
            <tr>
                <td>{{$cor->code}}</td>
                <td>{{$cor->name}}</td>
                <td>
                    <a href="{{route('cores.edit', ['cor' => $cor]) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Alterar</a>
                <td>
                <td>
                    <form action="{{route('cores.destroy', ['cor' => $cor]) }}" method="POST">
                        @crsf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

