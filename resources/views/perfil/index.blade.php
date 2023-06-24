@extends('layout')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('main')
    @yield('subtitulo')
    <div class="mt-4">
        @yield('main')
    </div>
    <a>
        @if(Auth::user()->photo_url)
            <img src="{{ asset('storage/photos/' . Auth::user()->photo_url) }}"
                 class="img-profile rounded-circle" height="130">
        @else
            <img src="{{ asset('img/default_img.png') }}" class="img-profile rounded-circle" height="130">
        @endif
    </a>
    <div class="container-fluid" style="margin-top: 15px">
        <table class="table">
            <thead>
            <tr>
                <th>Nome</th>
                <td>{{Auth::user()->name}}</td>
                <td>
                    <form action="{{ route('perfil.shared.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photo" accept=".jpg, .jpeg, .png">
                        <button type="submit" class="btn btn-primary btn-sm" style="border-color: black">
                            Alterar Foto
                        </button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Tipo de utilizador</th>

                <td>
                    @php
                        $userType = Auth::user()->user_type;
                        $userTypeMeanings = [
                            'A' => 'Administrador',
                            'E' => 'Empregado',
                            'C' => 'Cliente'
                        ];
                    @endphp
                    {{ isset($userTypeMeanings[$userType]) ? $userTypeMeanings[$userType] : 'Unknown' }}

                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ Auth::user()->email }}</td>
                <td></td>
            </tr>
            <tr>
                <th>Data de criação</th>
                <td>{{ Auth::user()->created_at }}</td>
                <td></td>
            </tr>
            <tr>
                <th>Última atualização de perfil</th>
                <td>{{ Auth::user()->updated_at }}</td>
                <td></td>
            </tr>

            @foreach($customers as $customer)

                @if(Auth::user()->id == $customer->id)
                    <tr>
                        <th>NIF</th>
                        <td> {{$customer->nif}} </td>
                    </tr>
                    <tr>
                        <th>Morada</th>
                        <td> {{$customer->address}} </td>
                    </tr>
                    <tr>
                        <th>Tipo de pagamento</th>
                        <td>
                            @if ($customer->default_payment_type == 'MC')
                                Master Card
                            @elseif ($customer->default_payment_type == 'PAYPAL')
                                PayPal
                            @elseif ($customer->default_payment_type == 'VISA')
                                Visa
                            @else
                                Não Atribuido
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Referência de Pagamento</th>
                        <td> {{$customer->default_payment_ref}} </td>
                    </tr>
                @endif

            @endforeach

            </thead>
        </table>
<br>
<br>
        @if(auth()->user()->user_type === 'A')
            <div class="container">
                <div style="display: flex; justify-content: center; margin-bottom: 15px">
                    <a href="{{ route('perfil.shared.edit', Auth::user()->id) }}" class="btn btn-primary btn-sm" role="button"
                       aria-pressed="true" style="border-color: black">
                        Editar Perfil
                    </a>
                </div>

            </div>
        @endif
<br>
<br>
<br>
<br>
<br>
<br>
        <div style="display: flex; justify-content: center; margin-bottom: 15px">
            <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                    Inicial
            </a>
        </div>

    </div>
@endsection
