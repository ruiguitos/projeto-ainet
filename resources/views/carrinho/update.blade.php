@extends('layout') 

@section('content')
    <h1>Update Cart</h1>

    <form action="{{ route('carrinho.update') }}" method="POST">
        @csrf
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id">

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1">


        <button type="submit">Update</button>
    </form>
@endsection
