
@extends('layout') 

@section('content')
    <h1>Remove Item</h1>

    <form action="{{ route('carrinho.remove') }}" method="POST">
        @csrf
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id">


        <button type="submit">Remove</button>
    </form>
@endsection
