@extends('layout')
@section('title', 'Pagamento')
@section('main')

    @guest
        <div class='alert alert-info'>
            Para prosseguir precisa iniciar sessão:
            <p></p>
            <button  onclick="window.location.href='login'">Iniciar Sessão</button>
        </div>
    @else
        <form method="POST" action="{{ route('concluir') }}">
            @csrf
            <table class="table">
                <thead>
                <tr>
                <tr>
                    <th>Nome</th>
                    <td>{{Auth::user()->name}}</td>
                </tr>
                <tr>
                    <th>Notas</th>
                    <td>
                        <input type="text" class="form-control" name="notas" id="inputNotas">
                        @error('notes')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>NIF</th>
                    <td>
                        <input type="int" class="form-control" name="nif" id="inputNif" value="{{old('nif', Auth::user()->cliente->nif)}}" required>
                        @error('nif')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Endereço de Envio</th>
                    <td>
                        <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', Auth::user()->cliente->endereco)}}" required>
                        @error('address')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Tipo de Pagamento</th>
                    <td>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="inputVisa" name="tipo_pagamento" required value="VISA" {{old('payment_type',  Auth::user()->customer->payment_type) == 'VISA' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inputVisa"> Visa </label>
                            <input type="radio" class="form-check-input ml-4" id="inputMasterCard" name="tipo_pagamento" value="MC" {{old('payment_type',  Auth::user()->customer->payment_type) == 'MC' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inputMasterCard"> Master Card </label>
                            <input type="radio" class="form-check-input ml-4" id="inputPaypal" name="tipo_pagamento" value="PAYPAL" {{old('payment_type',  Auth::user()->customer->payment_type) == 'PAYPAL' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inputPaypal"> Paypal </label>
                        </div>
                        @error('payment_type')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Referência de Pagamento</th>
                    <td>
                        <input type="text" class="form-control" name="ref_pagamento" id="inputRefpagamento" value="{{old('payment_ref', Auth::user()->customer->payment_ref)}}" required>
                        @error('payment_ref')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </td>

                </tr>
                <th></th>
                <th></th>
                </tr>
                </thead>
            </table>
            <p class="btn-holder"><button type="submit" class="btn btn-warning btn-block text-center" role="button">Pagar</button> </p>
        </form>
    @endguest
@endsection
