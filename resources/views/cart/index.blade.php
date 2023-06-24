@extends('layout')
@section('titulo', 'Checkout')
@section('main')

    <h1>Checkout</h1>

    @if ($items)
        <table class="table">
            <thead>
            <tr>
                <th>Image</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $index => $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/tshirt_base/' . $item['item']->color_code . '.jpg') }}" alt="T-Shirt Image" style="width: 100px; height: 100px;">
                    </td>
                    <td>{{ $item['size'] }}</td>
                    <td>{{ $item['color'] }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>{{ $item['item']->price }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                        <a href="{{ route('cart.remove', $index) }}" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5"></td>
                <td><strong>Total: </strong>{{ $totalPrice }}</td>
            </tr>
            </tbody>
        </table>

        <div class="text-center">
            <a href="{{ route('home') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    @else
        <p>No items in the cart.</p>
    @endif

@endsection
