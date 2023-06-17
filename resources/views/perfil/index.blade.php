@extends('layout')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('main')
    <table class="table">
        <thead>
        <tr>
            <th>Nome</th>
            <td>{{Auth::user()->name}}</td>
        </tr>
        <tr>
            <th>Foto</th>
            <td>{{Auth::user()->photo_url}}</td>

        </tr>
        <tr>
            <th>Tipo de utilizador:</th>
            <td>{{Auth::user()->user_type}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
        <tr>
            <th>Verified at:</th>
            <td>{{ Auth::user()->email_verified_at }}</td>
        </tr>
        </thead>
    </table>
    <table class="table">
        <tr>
            <th>NIF</th>
            <td>{{ Auth::user()->nif }}</td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td>{{Auth::user()->address}}</td>
        </tr>
        <tr>
            <th>Tipo de Pagamento</th>
            <td>
                @if (Auth::user()->customers)
                    @if (Auth::user()->customers->ref_type == 'MC')
                        Master Card
                    @elseif (Auth::user()->customers->ref_type == 'PAYPAL')
                        Pay Pal
                    @elseif (Auth::user()->customers->ref_type == 'VISA')
                        Visa
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <th>Referência de Pagamento</th>
            <td>
                @if (Auth::user()->customers)
                    {{ Auth::user()->customers->payment_ref }}
                @endif
            </td>
        </tr>
    </table>

    <!-- Edit Profile button -->
    <center>
        <a href="{{ route('perfil.edit', Auth::user()->id) }}" class="btn btn-primary btn-sm" role="button"
           aria-pressed="true" style="border-color: black">
            Editar Perfil
        </a>
    </center>
    <br>

    <center>
        {{--        <a href="{{ route('perfil.edit', Auth::user()->customers->id) }}" class="btn btn-primary btn-sm"--}}
        {{--           role="button" aria-pressed="true" style="border-color: black">Alterar Perfil</a>--}}
    </center>
    <br>
    <center><a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina Inicial</a>
    </center>

@endsection
