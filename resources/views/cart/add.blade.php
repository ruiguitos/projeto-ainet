<!-- resources/views/cart/add.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Item Added to Cart</title>
    <!-- CSS styles and other head elements -->
</head>
<body>
<h1>Item Added to Cart</h1>

<p>The item has been successfully added to your cart.</p>

<form action="{{ route('cart.view') }}" method="GET">
    <button type="submit">View Cart</button>
</form>

<!-- Additional content for the cart.add view -->
<footer>
    <a href="{{ route('home') }}" class="btn btn-default" style="border-color: black; align-items: flex-end">Voltar à Pagina Inicial</a>
</footer>
</body>
</html>
