{{--@extends('layout')--}}
{{--@section('title', 'Pagamento')--}}
{{--@section('sidebar')--}}
{{--    @include('partials.sidebar')--}}
{{--@endsection--}}
{{--@section('main')--}}

{{--    @guest--}}
{{--        <div class='alert alert-info'>--}}
{{--            Para prosseguir precisa iniciar sessão:--}}
{{--            <p></p>--}}
{{--            <button  onclick="window.location.href='login'">Iniciar Sessão</button>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <form method="POST" action="{{ route('concluir') }}">--}}
{{--            @csrf--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                <tr>--}}
{{--                    <th>Nome</th>--}}
{{--                    <td>{{Auth::user()->name}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Notas</th>--}}
{{--                    <td>--}}
{{--                        <input type="text" class="form-control" name="notas" id="inputNotas">--}}
{{--                        @error('notas')--}}
{{--                        <div class="small text-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>NIF</th>--}}
{{--                    <td>--}}
{{--                        <input type="int" class="form-control" name="nif" id="inputNif" value="{{old('nif', Auth::user()->cliente->nif)}}" required>--}}
{{--                        @error('nif')--}}
{{--                        <div class="small text-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Endereço de Envio</th>--}}
{{--                    <td>--}}
{{--                        <input type="text" class="form-control" name="endereco" id="inputEndereco" value="{{old('endereco', Auth::user()->cliente->endereco)}}" required>--}}
{{--                        @error('endereco')--}}
{{--                        <div class="small text-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Tipo de Envio</th>--}}
{{--                    <td>--}}
{{--                        <select id="inputEnvio" name="tipo_envio" aria-label="envio" autocomplete="envio" required>--}}
{{--                            <option value="">--</option>--}}
{{--                            <option value="CTT">Correios</option>--}}
{{--                            <option value="PontoRecolha">Ponto de Recolha</option>--}}
{{--                        </select>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Data Prevista para Receber</th>--}}
{{--                    <td>--}}
{{--                        {{ date('Y-m-d', strtotime("+6 day")) }}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Tipo de Pagamento</th>--}}
{{--                    <td>--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input type="radio" class="form-check-input" id="inputVisa" name="tipo_pagamento" required value="VISA" {{old('tipo_pagamento',  Auth::user()->cliente->tipo_pagamento) == 'VISA' ? 'checked' : ''}}>--}}
{{--                            <label class="form-check-label" for="inputVisa"> Visa </label>--}}
{{--                            <input type="radio" class="form-check-input ml-4" id="inputMasterCard" name="tipo_pagamento" value="MC" {{old('tipo_pagamento',  Auth::user()->cliente->tipo_pagamento) == 'MC' ? 'checked' : ''}}>--}}
{{--                            <label class="form-check-label" for="inputMasterCard"> Master Card </label>--}}
{{--                            <input type="radio" class="form-check-input ml-4" id="inputPaypal" name="tipo_pagamento" value="PAYPAL" {{old('tipo_pagamento',  Auth::user()->cliente->tipo_pagamento) == 'PAYPAL' ? 'checked' : ''}}>--}}
{{--                            <label class="form-check-label" for="inputPaypal"> Paypal </label>--}}
{{--                        </div>--}}
{{--                        @error('tipo_pagamento')--}}
{{--                        <div class="small text-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Referência de Pagamento</th>--}}
{{--                    <td>--}}
{{--                        <input type="text" class="form-control" name="ref_pagamento" id="inputRefpagamento" value="{{old('ref_pagamento', Auth::user()->cliente->ref_pagamento)}}" required>--}}
{{--                        @error('ref_pagamento')--}}
{{--                        <div class="small text-danger">{{$message}}</div>--}}
{{--                        @enderror--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--                <th></th>--}}
{{--                <th></th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--            </table>--}}
{{--            <p class="btn-holder"><button type="submit" class="btn btn-warning btn-block text-center" role="button">Pagar</button> </p>--}}
{{--        </form>--}}
{{--    @endguest--}}
{{--@endsection--}}
