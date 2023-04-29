@extends('layouts.app')
@section('title','MagicShirts' )
@section('sidebar')
    @include('partials.sidebar')
@endsection
@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Magic T-Shirts</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/app.css">
</head>
<body>
	<header>
		<div class="container">
			<h1>Online Shop</h1>
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Produtos</a></li>
					<li><a href="#">Acerca de Nós</a></li>
					<li><a href="#">Contactos</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section>
		<div class="container">
			<h2>Bem vindo a nossa loja </h2>
			<p>Temos bueda merdas</p>
			<a href="#" class="button">Compra AQUI BURRO</a>
		</div>
	</section>

	<footer>
		<div class="container">
			
		</div>
	</footer>
</body>
</html>
@endsection
