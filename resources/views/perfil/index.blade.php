@extends('layout')
@section('main')
    <table class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <td>{{Auth::user()->name}}</td>
        </tr>
        <tr>
            <th>Tipo de utilizador:</th>
            <td>{{Auth::user()->user_type}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{Auth::user()->email}}</td>
        </tr>
        <tr>
            <th>Verified at:</th>
            <td>{{Auth::user()->email_verified_at}}</td>
        </tr>
        </thead>
    </table>
    <table class="table">
        <tr>
            <th>NIF</th>
            {{--            <td>{{ Auth::user()->nif }}</td>--}}
        </tr>
        <tr>
            <th>Endereço</th>
            {{--            <td>{{Auth::user()->address}}</td>--}}
        </tr>
        <tr>
            <th>Tipo de Pagamento</th>
        {{--                        @if(Auth::user()->customer->ref_type == 'MC')--}}
        {{--                            <td>Master Card</td>--}}
        {{--                        @elseif(Auth::user()->customer->ref_type == 'PAYPAL')--}}
        {{--                            <td>Pay Pal</td>--}}
        {{--                        @elseif(Auth::user()->customer->ref_type == 'VISA')--}}
        {{--                            <td>Visa</td>--}}
        {{--                        @else--}}
        {{--                            <td></td>--}}
        {{--                        @endif--}}
        {{--        </tr>--}}
        <tr>
            <th>Referência de Pagamento</th>
            {{--            <td>{{Auth::user()->customer->payment_ref}}</td>--}}
        </tr>
    </table>
    <center>
        {{--        <a href="{{ route('perfil.edit', Auth::user()->customer->id) }}" class="btn btn-primary btn-sm"--}}
        {{--           role="button" aria-pressed="true" style="border-color: black">Alterar Perfil</a>--}}
    </center>
    <br>
    <center><a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial</a>
    </center>

@endsection
