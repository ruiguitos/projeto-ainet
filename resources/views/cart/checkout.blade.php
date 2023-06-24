@extends('layout')

@section('content')
    <h1>Checkout</h1>

    <form action="{{ route('carrinho.checkout') }}" method="POST">
        @csrf
        <!-- Include your form fields for checkout, such as user details, shipping address, payment information, etc. -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">


        <button type="submit">Place Order</button>
    </form>
@endsection