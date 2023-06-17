<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ImagemController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CATALOGO
Route::get('/catalogo', [App\Http\Controllers\CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{id}', [App\Http\Controllers\CatalogoController::class, 'show'])->name('catalogo.show');

//IMAGEM
Route::get('/imagem', [App\Http\Controllers\ImagemController::class, 'index'])->name('imagem.index');



//ADMIN DASHBOARD
Route::view('/dashboard', 'dashboard.index');
Route::view('/dashboard/charts', 'dashboard.charts');
Route::view('/dashboard/tables', 'dashboard.tables');

//PERFIL
Route::view('/perfil', 'perfil.index');
Route::get('/perfil/{customer}', [CustomerController::class, 'index'])->name('perfil.index');
Route::get('/perfil/{customer}/edit', [CustomerController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil/{customer}', [CustomerController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/{customer}', [CustomerController::class, 'destroy'])->name('perfil.destroy');
Route::delete('/perfil/{customer}/photo', [CustomerController::class, 'destroy_photo'])->name('perfil.photo.destroy');


//CARRINHO
Route::view('/carrinho', 'carrinho.index');
Route::view('/pagamento', 'carrinho.pagamento');

Route::post('/carrinho/add/{tshirt}', [CarrinhoController::class, 'add'])->name('carrinho.add');


//Categorias
Route::view('/categorias', [CatalogoController::class, 'index'])->name('categorias.index');

//Cores
Route::view('/cores', 'cores.index');




//Clientes
Route::get('/clientes', [UserController::class, 'showClients'])->name('clientes.index');

//Encomendas
Route::view('/encomendas', 'encomendas.index');

//Empregados
Route::view('/empregados', 'empregados.index');
Route::view('/clientes', 'clientes.index');





//Route::get('carrinho', [EstampaController::class, 'cart'])->name('carrinho.index');
//Route::post('add-to-cart/{id}', [EstampaController::class, 'addToCart']);
//Route::patch('update-cart', [EstampaController::class, 'updateCarrinho']);
//Route::delete('remove-from-cart', [EstampaController::class, 'removeCarrinho']);
//Route::get('pagamento', [EstampaController::class, 'pagamento'])->name('pagamento');
//Route::post('concluir', [EstampaController::class, 'concluirPagamento'])->name('concluir');

//CHANGE PASSWORD
Route::view('/password/reset', 'auth.passwords.reset');

