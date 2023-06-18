@extends('layout')
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('main')
    <div class="container-fluid" style="margin-top: 15px">
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

        <div class="container">
            <div style="display: flex; justify-content: center; margin-bottom: 15px">
                <a href="{{ route('perfil.edit', Auth::user()->id) }}" class="btn btn-primary btn-sm" role="button"
                   aria-pressed="true" style="border-color: black">
                    Editar Perfil
                </a>
            </div>

            <!-- Edit Photo button -->
            <div style="display: flex; justify-content: center; margin-bottom: 15px">
                <a href="{{ route('perfil.edit', Auth::user()->id) }}" class="btn btn-primary btn-sm" role="button"
                   aria-pressed="true" style="border-color: black">
                    Editar Foto
                </a>
            </div>
        </div>
        <!-- Edit Profile button -->


        <div style="display: flex; justify-content: center; margin-bottom: 15px">
            <a href="{{ route('home')}}" class="btn btn-default" style="border-color: black">Voltar à Pagina
                    Inicial
            </a>
        </div>

    </div>
@endsection
