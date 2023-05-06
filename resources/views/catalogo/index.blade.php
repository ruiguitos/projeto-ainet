@extends('layout')

@section('content')
{{--    <table class="table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Estampa</th>--}}
{{--            <th>Cor</th>--}}
{{--            <th>Tam.</th>--}}
{{--            <th>Quant.</th>--}}
{{--            <th>preco un.</th>--}}
{{--            <th>Subtotal</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach ($tshirt_images as $tshirt)--}}
{{--            <tr>--}}
{{--                <td>{{$tshirt->estampaRef->nome}}</td>--}}
{{--                <td>{{$tshirt->coreRef->nome}}</td>--}}
{{--                <td>{{$tshirt->tamanho}}</td>--}}
{{--                <td>{{$tshirt->quantidade}}</td>--}}
{{--                <td>{{$tshirt->preco_un}}</td>--}}
{{--                <td>{{$tshirt->subtotal}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    {{ $tshirts->withQueryString()->links() }}--}}
@endsection
